package main

import (
	"database/sql"
	"fmt"
	"io"
	"log"
	"net/http"
	"net/url"
	"time"
)

// ProcessInvestment handles the full investment cycle (activation to completion)
func ProcessInvestment(investmentID, userID string) {
	if DB == nil {
		log.Println("❌ DB not initialized")
		return
	}

	var planID int
	var amountInvested float64
	var cryptoSymbol string
	var accumulatedProfit sql.NullFloat64
	var lastEarningTime sql.NullTime

	err := DB.QueryRow(`
		SELECT plan_id, amount_invested, crypto_symbol, change_value, last_earning_time
		FROM investments 
		WHERE investment_id = ? AND user_id = ? LIMIT 1
	`, investmentID, userID).Scan(&planID, &amountInvested, &cryptoSymbol, &accumulatedProfit, &lastEarningTime)

	if err != nil {
		log.Println("Investment not found or db error.", err)
		return
	}

	var durationMinutes int
	var roi float64
	err = DB.QueryRow(`
		SELECT duration, roi FROM investment_plans WHERE plan_id = ? LIMIT 1
	`, planID).Scan(&durationMinutes, &roi)

	if err != nil {
		log.Println("Plan not found.", err)
		return
	}

	_, err = DB.Exec(`
		UPDATE investments SET status = 'active' 
		WHERE investment_id = ? AND status = 'paused'
		OR investment_id = ? AND status = 'pending'
	`, investmentID, investmentID)
	if err != nil {
		log.Println("Failed to activate investment.", err)
		return
	} else {
		log.Printf("▶️ Investment %s activated for user %s.\n", investmentID, userID)
	}

	cancelChan := make(chan bool)
	pauseChan := make(chan bool)

	cancelMutex.Lock()
	cancelMap[investmentID] = cancelChan
	cancelMutex.Unlock()

	pauseMutex.Lock()
	pauseMap[investmentID] = pauseChan
	pauseMutex.Unlock()

	totalDuration := time.Duration(durationMinutes) * time.Minute
	totalProfit := amountInvested * roi / 100
	totalSeconds := totalDuration.Seconds()
	profitPerSecond := totalProfit / totalSeconds

	parsedAccumulated := 0.0
	if accumulatedProfit.Valid {
		parsedAccumulated = accumulatedProfit.Float64

	} else {
		log.Println("No previous accumulated profit found, starting from zero.")
		parsedAccumulated = 0.0
	}

	accumulated := parsedAccumulated
	updateInterval := 5 * time.Second
	ticker := time.NewTicker(updateInterval)
	defer ticker.Stop()

	startTime := time.Now()

	for {
		select {
		case <-cancelChan:
			log.Printf("🛑 Investment %s cancelled.", investmentID)
			_, err := DB.Exec(`
				UPDATE investments
				SET change_value = ?, last_earning_time = ?
				WHERE investment_id = ?
			`, accumulated, time.Now(), investmentID)
			if err != nil {
				log.Println("Failed to save progress.", err)
			}
			cancelMutex.Lock()
			delete(cancelMap, investmentID)
			cancelMutex.Unlock()
			return
		case paused := <-pauseChan:
			if paused {
				log.Printf("⏸ Investment %s paused.", investmentID)
				for {
					resumed := <-pauseChan
					if !resumed {
						log.Printf("▶️ Investment %s resumed.", investmentID)
						startTime = time.Now()
						break
					}
				}
			}
		case <-ticker.C:
			elapsed := time.Since(startTime).Seconds()
			if elapsed+(parsedAccumulated/profitPerSecond) >= totalSeconds {
				goto COMPLETE
			}

			accumulated += profitPerSecond * updateInterval.Seconds()
			_, err := DB.Exec(`
				UPDATE investments
				SET change_value = ?, last_earning_time = ?
				WHERE investment_id = ?
			`, accumulated, time.Now(), investmentID)

			if err != nil {
				log.Println("❌ Failed to update change_value.", err)
				return
			}

			log.Printf("⏳ [%s] Live profit updated: %.6f", investmentID, accumulated)
		}
	}

COMPLETE:
	_, err = DB.Exec(`
		UPDATE investments
		SET total_profit = ?, change_value = 0, status = 'completed', completed_at = NOW()
		WHERE investment_id = ?
	`, totalProfit, investmentID)
	if err != nil {
		log.Println("Failed to complete investment.", err)
		return
	}

	var currencyID int
	err = DB.QueryRow(`
		SELECT id FROM currencies WHERE crypto_symbol = ?
	`, cryptoSymbol).Scan(&currencyID)
	if err != nil {
		log.Println("Failed to get currency ID.", err)
		return
	}

	_, err = DB.Exec(`
		UPDATE users_wallet 
		SET amount = amount + ? 
		WHERE user_id = ? AND currency_id = ?
	`, totalProfit+amountInvested, userID, currencyID)
	if err != nil {
		log.Println("Failed to credit user's wallet.", err)
		return
	}

	var cryptoName, planName string
	var newBalance float64

	err = DB.QueryRow(`SELECT crypto_name FROM currencies WHERE crypto_symbol = ? LIMIT 1`, cryptoSymbol).Scan(&cryptoName)
	if err != nil {
		log.Println("Failed to fetch crypto name.", err)
		return
	}

	err = DB.QueryRow(`SELECT plan_name FROM investment_plans WHERE plan_id = ? LIMIT 1`, planID).Scan(&planName)
	if err != nil {
		log.Println("Failed to fetch plan name.", err)
		return
	}

	err = DB.QueryRow(`
		SELECT uw.amount
		FROM users_wallet uw
		JOIN currencies c ON uw.currency_id = c.id
		WHERE uw.user_id = ? AND c.crypto_symbol = ?
	`, userID, cryptoSymbol).Scan(&newBalance)
	if err != nil {
		log.Println("Failed to fetch new balance.", err)
		return
	}

	notificationMessage := fmt.Sprintf(
		"Your Investment of %.2f USD in %s (%s), in the %s plan, has been successfully completed and your new %s balance is %.2f USD",
		amountInvested, cryptoName, cryptoSymbol, planName, cryptoSymbol, newBalance)

	notificationSymbol := "https://cdn-icons-png.flaticon.com/512/4957/4957559.png"

	_, err = DB.Exec(`
		INSERT INTO notifications (user_id, message, notification_symbol) 
		VALUES (?, ?, ?)
	`, userID, notificationMessage, notificationSymbol)
	if err != nil {
		log.Println("Failed to insert notification.", err)
		return
	}

	postData := url.Values{}
	postData.Set("user_id", userID)
	postData.Set("subject", "Investment Completed")
	postData.Set("message", notificationMessage)

	resp, err := http.PostForm("http://localhost/chain-fortune/action/investment_email", postData)
	if err != nil {
		log.Println("Failed to send email.", err)
		return
	}
	defer resp.Body.Close()

	if resp.StatusCode != http.StatusOK {
		bodyBytes, _ := io.ReadAll(resp.Body)
		log.Printf("Email backend responded with status %d: %s", resp.StatusCode, string(bodyBytes))
	} else {
		log.Println("Investment success email sent successfully.")
	}

	log.Printf("✅ Investment %s completed. Total profit %.2f credited to user %s", investmentID, totalProfit, userID)
}

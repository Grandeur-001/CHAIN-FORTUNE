package main

import (
	"fmt"
	"io"
	"log"
	"net/http"
	"net/url"
	"sync"
)

var cancelMap = make(map[string]chan bool)
var cancelMutex sync.Mutex

func CancelInvestment(investmentID string) error {
	cancelMutex.Lock()
	cancelChan, exists := cancelMap[investmentID]
	cancelMutex.Unlock()

	if !exists {
		return fmt.Errorf("❌ No running investment found with ID %s to cancel", investmentID)
	}

	cancelChan <- true
	log.Printf("🛑 Cancellation signal sent for investment %s\n", investmentID)

	cancelMutex.Lock()
	delete(cancelMap, investmentID)
	cancelMutex.Unlock()

	// Retrieve investment info
	var userID, cryptoSymbol, cryptoName, planName string
	var amountInvested float64

	err := DB.QueryRow(`
		SELECT user_id, amount_invested, crypto_symbol, plan_id
		FROM investments WHERE investment_id = ?
	`, investmentID).Scan(&userID, &amountInvested, &cryptoSymbol, &planName)
	if err != nil {
		return fmt.Errorf("Failed to retrieve investment info for notification: %v", err)
	}

	// Update investment to canceled
	_, err = DB.Exec(`
		UPDATE investments 
		SET status = 'canceled', change_value = 0
		WHERE investment_id = ? AND status = 'active'
	`, investmentID)
	if err != nil {
		return fmt.Errorf("❌ Failed to update investment status to 'canceled' for %s: %v", investmentID, err)
	}

	// Credit back user's wallet
	var currencyID int
	err = DB.QueryRow(`
		SELECT id FROM currencies WHERE crypto_symbol = ?
	`, cryptoSymbol).Scan(&currencyID)
	if err != nil {
		return fmt.Errorf("Failed to get currency ID: %v", err)
	}

	_, err = DB.Exec(`
		UPDATE users_wallet 
		SET amount = amount + ? 
		WHERE user_id = ? AND currency_id = ?
	`, amountInvested, userID, currencyID)
	if err != nil {
		return fmt.Errorf("Failed to credit user's wallet: %v", err)
	}

	// Retrieve additional info for notification
	err = DB.QueryRow(`SELECT crypto_name FROM currencies WHERE crypto_symbol = ? LIMIT 1`, cryptoSymbol).Scan(&cryptoName)
	if err != nil {
		return fmt.Errorf("Failed to fetch crypto name: %v", err)
	}

	err = DB.QueryRow(`SELECT plan_name FROM investment_plans WHERE plan_id = ? LIMIT 1`, planName).Scan(&planName)
	if err != nil {
		return fmt.Errorf("Failed to fetch plan name: %v", err)
	}

	notificationMessage := fmt.Sprintf(
		"Your Investment of %.2f USD in %s (%s), in the %s plan, has been canceled. Your investment amount has been credited back to your wallet.",
		amountInvested,
		cryptoName,
		cryptoSymbol,
		planName,
	)

	notificationSymbol := "https://cdn-icons-png.flaticon.com/512/1828/1828843.png"

	_, err = DB.Exec(`
		INSERT INTO notifications (user_id, message, notification_symbol) 
		VALUES (?, ?, ?)
	`, userID, notificationMessage, notificationSymbol)
	if err != nil {
		return fmt.Errorf("Failed to insert notification: %v", err)
	}

	postData := url.Values{}
	postData.Set("user_id", userID)
	postData.Set("message", notificationMessage)
	postData.Set("subject", "Investment Cancelled")

	resp, err := http.PostForm("http://localhost/chain-fortune/action/investment_email", postData)
	if err != nil {
		return fmt.Errorf("Failed to send email: %v", err)
	}
	defer resp.Body.Close()

	if resp.StatusCode != http.StatusOK {
		bodyBytes, _ := io.ReadAll(resp.Body)
		return fmt.Errorf("Email backend responded with status %d: %s", resp.StatusCode, string(bodyBytes))
	}

	log.Println("Cancellation notification email sent successfully.")
	return nil
}

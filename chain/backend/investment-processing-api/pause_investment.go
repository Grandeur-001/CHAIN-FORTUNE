package main

import (
	"fmt"
	"io"
	"log"
	"net/http"
	"net/url"
	"sync"
)

// Map to keep track of running investment pause signals
var pauseMap = make(map[string]chan bool)
var pauseMutex sync.Mutex

// PauseInvestment pauses a running investment by ID and updates status to 'paused'
func PauseInvestment(investmentID string) error {
	pauseMutex.Lock()
	pauseChan, exists := cancelMap[investmentID]
	pauseMutex.Unlock()

	if !exists {
		return fmt.Errorf("⚠️ No running investment found with ID %s to pause", investmentID)
	}

	// Signal pause
	pauseChan <- true
	log.Printf("⏸️ Pause signal sent for investment %s\n", investmentID)

	_, err := DB.Exec(`
		UPDATE investments 
		SET status = 'paused' 
		WHERE investment_id = ? AND status = 'active'
	`, investmentID)
	if err != nil {
		return fmt.Errorf("❌ Failed to update investment status to 'paused' for %s: %v", investmentID, err)
	}

	log.Printf("⏸️ Investment %s paused successfully.\n", investmentID)

	// Notification logic
	var userID, cryptoSymbol, cryptoName, planName string
	var amountInvested float64

	err = DB.QueryRow(`
		SELECT user_id, amount_invested, crypto_symbol 
		FROM investments WHERE investment_id = ?
	`, investmentID).Scan(&userID, &amountInvested, &cryptoSymbol)
	if err != nil {
		return fmt.Errorf("Failed to retrieve investment info for notification: %v", err)
	}

	err = DB.QueryRow(`SELECT crypto_name FROM currencies WHERE crypto_symbol = ?`, cryptoSymbol).Scan(&cryptoName)
	if err != nil {
		return fmt.Errorf("Failed to fetch crypto name: %v", err)
	}

	err = DB.QueryRow(`
		SELECT ip.plan_name FROM investment_plans ip
		JOIN investments i ON ip.plan_id = i.plan_id
		WHERE i.investment_id = ?
	`, investmentID).Scan(&planName)
	if err != nil {
		return fmt.Errorf("Failed to fetch plan name: %v", err)
	}

	notificationMessage := fmt.Sprintf(
		"Your Investment of %.2f USD in %s (%s), in the %s plan, has been suspended by the Administrator. Please contact support for more information.",
		amountInvested,
		cryptoName,
		cryptoSymbol,
		planName,
	)

	notificationSymbol := "https://cdn-icons-png.flaticon.com/512/16823/16823021.png"

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
	postData.Set("subject", "Investment Paused")

	resp, err := http.PostForm("http://localhost/chain-fortune/action/investment_email", postData)
	if err != nil {
		return fmt.Errorf("Failed to send email: %v", err)
	}
	defer resp.Body.Close()

	if resp.StatusCode != http.StatusOK {
		bodyBytes, _ := io.ReadAll(resp.Body)
		return fmt.Errorf("Email backend responded with status %d: %s", resp.StatusCode, string(bodyBytes))
	}

	log.Println("Pause notification email sent successfully.")
	return nil
}

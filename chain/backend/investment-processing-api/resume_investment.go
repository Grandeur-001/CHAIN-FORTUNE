package main

import (
	"fmt"
	"io"
	"log"
	"net/http"
	"net/url"
)

// ResumeInvestment resumes a paused investment and sets it back to 'active'
func ResumeInvestment(investmentID string) error {
	var userID, cryptoSymbol, cryptoName, planName string
	var amountInvested float64

	// Fetch investment info
	err := DB.QueryRow(`
		SELECT user_id, amount_invested, crypto_symbol 
		FROM investments 
		WHERE investment_id = ? AND status = 'paused'
	`, investmentID).Scan(&userID, &amountInvested, &cryptoSymbol)

	if err != nil {
		return fmt.Errorf("❌ No paused investment found with ID %s or failed to retrieve info: %v", investmentID, err)
	}

	// Update to active
	_, err = DB.Exec(`
		UPDATE investments 
		SET status = 'active' 
		WHERE investment_id = ?
	`, investmentID)
	if err != nil {
		return fmt.Errorf("❌ Failed to update status to active for %s: %v", investmentID, err)
	}

	log.Printf("▶️ Resuming investment %s for user %s...\n", investmentID, userID)

	// Fetch names for notification
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

	// Create notification message
	notificationMessage := fmt.Sprintf(
		"Your Investment of %.2f USD in %s (%s), in the %s plan, has been successfully resumed. You will now continue earning.",
		amountInvested,
		cryptoName,
		cryptoSymbol,
		planName,
	)

	notificationSymbol := "https://cdn-icons-png.flaticon.com/512/4407/4407412.png"

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
	postData.Set("subject", "Investment Resumed")

	resp, err := http.PostForm("http://localhost/chain-fortune/action/investment_email", postData)
	if err != nil {
		return fmt.Errorf("Failed to send email: %v", err)
	}
	defer resp.Body.Close()

	if resp.StatusCode != http.StatusOK {
		bodyBytes, _ := io.ReadAll(resp.Body)
		return fmt.Errorf("Email backend responded with status %d: %s", resp.StatusCode, string(bodyBytes))
	}

	log.Println("Resume notification email sent successfully.")

	// Resume processing
	go ProcessInvestment(investmentID, userID)
	return nil
}

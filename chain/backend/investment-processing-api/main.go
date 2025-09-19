package main

import (
	"encoding/json"
	"log"
	"net/http"
)

func main() {
	InitDB()
	defer DB.Close()

	http.HandleFunc("/process_investment", handleInvestmentProcessing)
	http.HandleFunc("/cancel_investment", handleInvestmentCancellation)
	http.HandleFunc("/pause_investment", handleInvestmentPause)
	http.HandleFunc("/resume_investment", handleInvestmentResume)

	log.Println("🚀 Server running on port 8080...")
	log.Fatal(http.ListenAndServe(":8080", nil))
}

// POST: /process_investment
func handleInvestmentProcessing(w http.ResponseWriter, r *http.Request) {
	if r.Method != http.MethodPost {
		http.Error(w, "Method Not Allowed", http.StatusMethodNotAllowed)
		return
	}

	var req InvestmentRequest
	if err := json.NewDecoder(r.Body).Decode(&req); err != nil || req.InvestmentID == "" || req.UserID == "" {
		http.Error(w, "Invalid JSON or missing fields", http.StatusBadRequest)
		return
	}

	go ProcessInvestment(req.InvestmentID, req.UserID)

	w.Header().Set("Content-Type", "application/json")
	w.Write([]byte(`{"status": "success"}`))
}

// POST: /cancel_investment
func handleInvestmentCancellation(w http.ResponseWriter, r *http.Request) {
	if r.Method != http.MethodPost {
		http.Error(w, "Method Not Allowed", http.StatusMethodNotAllowed)
		return
	}

	var req InvestmentRequest
	if err := json.NewDecoder(r.Body).Decode(&req); err != nil || req.InvestmentID == "" {
		http.Error(w, "Invalid JSON or missing investment_id", http.StatusBadRequest)
		return
	}

	err := CancelInvestment(req.InvestmentID)

	w.Header().Set("Content-Type", "application/json")
	if err != nil {
		w.WriteHeader(http.StatusInternalServerError)
		json.NewEncoder(w).Encode(map[string]string{
			"status":  "error",
			"message": err.Error(),
		})
		return
	}

	json.NewEncoder(w).Encode(map[string]string{
		"status":  "success",
		"message": "Investment cancelled successfully",
	})
}

// POST: /pause_investment
func handleInvestmentPause(w http.ResponseWriter, r *http.Request) {
	if r.Method != http.MethodPost {
		http.Error(w, "Method Not Allowed", http.StatusMethodNotAllowed)
		return
	}

	var req InvestmentRequest
	if err := json.NewDecoder(r.Body).Decode(&req); err != nil || req.InvestmentID == "" {
		http.Error(w, "Invalid JSON or missing investment_id", http.StatusBadRequest)
		return
	}

	err := PauseInvestment(req.InvestmentID)

	w.Header().Set("Content-Type", "application/json")
	if err != nil {
		w.WriteHeader(http.StatusInternalServerError)
		json.NewEncoder(w).Encode(map[string]string{
			"status":  "error",
			"message": err.Error(),
		})
		return
	}

	json.NewEncoder(w).Encode(map[string]string{
		"status":  "success",
		"message": "Investment paused successfully",
	})
}

// POST: /resume_investment
func handleInvestmentResume(w http.ResponseWriter, r *http.Request) {
	if r.Method != http.MethodPost {
		http.Error(w, "Method Not Allowed", http.StatusMethodNotAllowed)
		return
	}

	var req InvestmentRequest
	if err := json.NewDecoder(r.Body).Decode(&req); err != nil || req.InvestmentID == "" {
		http.Error(w, "Invalid JSON or missing investment_id", http.StatusBadRequest)
		return
	}

	err := ResumeInvestment(req.InvestmentID)

	w.Header().Set("Content-Type", "application/json")
	if err != nil {
		w.WriteHeader(http.StatusInternalServerError)
		json.NewEncoder(w).Encode(map[string]string{
			"status":  "error",
			"message": err.Error(),
		})
		return
	}

	json.NewEncoder(w).Encode(map[string]string{
		"status":  "success",
		"message": "Investment resumed successfully",
	})
}

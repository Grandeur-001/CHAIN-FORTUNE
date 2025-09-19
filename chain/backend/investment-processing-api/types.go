package main

type InvestmentRequest struct {
	InvestmentID string `json:"investment_id"`
	UserID       string `json:"user_id,omitempty"` // optional for cancel
}

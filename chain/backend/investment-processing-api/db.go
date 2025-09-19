package main

import (
	"database/sql"
	"fmt"
	"log"
	"os"

	_ "github.com/go-sql-driver/mysql"
	"github.com/joho/godotenv"
)

var DB *sql.DB

// InitDB initializes the MySQL database connection
func InitDB() {
	err := godotenv.Load()
	if err != nil {
		log.Fatal("❌ Error loading .env file")
	}

	dsn := fmt.Sprintf("%s:%s@tcp(%s)/%s?parseTime=true",
		os.Getenv("MYSQL_USER"),
		os.Getenv("MYSQL_PASSWORD"),
		os.Getenv("MYSQL_HOST"),
		os.Getenv("MYSQL_DATABASE"),
	)

	DB, err = sql.Open("mysql", dsn)
	if err != nil {
		log.Fatal("❌ Could not open DB connection:", err)
	}

	if err := DB.Ping(); err != nil {
		log.Fatal("❌ Could not ping DB:", err)
	}

	fmt.Println("✅ MySQL DB connected successfully")
}

<?php

// Define a class for URL shortening
class URLShortener {
    private $conn; // Database connection object
    
    // Constructor to establish database connection
    public function __construct($servername, $username, $password, $database) {
        // Create a new MySQLi object for database connection
        $this->conn = new mysqli($servername, $username, $password, $database);
        
        // Check if the connection was successful
        if ($this->conn->connect_error) {
            // If connection fails, display an error message and terminate script
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    
    // Destructor to close database connection
    public function __destruct() {
        // Close the database connection when the object is destroyed
        $this->conn->close();
    }
    
    // Function to generate a unique short code
    private function generateShortCode() {
        // Define characters for short code generation
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $shortCode = '';
        $length = 8; // Length of the short code
        
        // Generate a random short code of specified length
        for ($i = 0; $i < $length; $i++) {
            $shortCode .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        // Return the generated short code
        return $shortCode;
    }
    
    // Function to shorten a URL
    public function shortenURL($originalURL) {
        // Check if the original URL already exists in the database
        $sql = "SELECT short_code FROM urls WHERE original_url = ?";
        
        // Prepare the SQL statement
        $stmt = $this->conn->prepare($sql);
        
        // Bind parameters
        $stmt->bind_param("s", $originalURL);
        
        // Execute the query
        $stmt->execute();
        
        // Store the result
        $result = $stmt->get_result();
        
        // If the URL already exists, return its corresponding short code
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["short_code"];
        } else {
            // If the URL doesn't exist, generate a new short code
            $shortCode = $this->generateShortCode();
            
            // Insert the original URL and its corresponding short code into the database
            $sql = "INSERT INTO urls (original_url, short_code) VALUES (?, ?)";
            
            // Prepare the SQL statement
            $stmt = $this->conn->prepare($sql);
            
            // Bind parameters
            $stmt->bind_param("ss", $originalURL, $shortCode);
            
            // Execute the query
            if ($stmt->execute()) {
                return $shortCode; // Return the generated short code
            } else {
                // If there's an error in executing the SQL query, return an error message
                return "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }
    }
    
    // Function to retrieve the original URL from its short code
    public function getOriginalURL($shortCode) {
        // Retrieve the original URL from the database based on the provided short code
        $sql = "SELECT original_url FROM urls WHERE short_code = ?";
        
        // Prepare the SQL statement
        $stmt = $this->conn->prepare($sql);
        
        // Bind parameters
        $stmt->bind_param("s", $shortCode);
        
        // Execute the query
        $stmt->execute();
        
        // Store the result
        $result = $stmt->get_result();
        
        // If a corresponding URL is found, return it
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["original_url"];
        } else {
            // If no corresponding URL is found, return an error message
            return "Short URL not found";
        }
    }
}

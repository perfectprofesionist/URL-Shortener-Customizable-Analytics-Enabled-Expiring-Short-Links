-- Create a table to store URL mappings
CREATE TABLE urls (
    id INT AUTO_INCREMENT PRIMARY KEY,
    original_url VARCHAR(255) NOT NULL,
    short_code VARCHAR(20) NOT NULL
);

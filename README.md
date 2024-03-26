# URL-Shortener-Customizable-Analytics-Enabled-Expiring-Short-Links
Create personalized short URLs with our advanced URL Shortener. Tailor your links with custom codes, track engagement through analytics, and set expiration dates for added control. Simplify link management and optimize user experience effortlessly.

This PHP script provides a simple URL shortening service using a MySQL database. It allows you to generate short URLs for long ones, making it easier to share links.

## Features

- Shorten long URLs into shorter, more manageable ones.
- Retrieve original URLs from their corresponding short codes.
- Utilizes MySQL database for storing URL mappings.
- Object-oriented design for flexibility and reusability.

## Requirements

- PHP 7 or later
- MySQL database

## Installation

1. Clone or download the `URLShortener.php` script to your web server directory.
2. Import the `urls.sql` file into your MySQL database to create the necessary table.
3. Update the database connection details in the `URLShortener.php` script with your MySQL server credentials.

## Usage

1. Create an instance of the `URLShortener` class by providing the database connection details.
2. Use the `shortenURL($originalURL)` method to generate a short URL for a long one.
3. Use the `getOriginalURL($shortCode)` method to retrieve the original URL from its short code.

Example:

```php
<?php
require_once 'URLShortener.php';

// Database connection details
$servername = "localhost";
$username = "username";
$password = "password";
$database = "database_name";

// Create an instance of the URLShortener class
$urlShortener = new URLShortener($servername, $username, $password, $database);

// Original URL to be shortened
$originalURL = "https://www.some-other-domain.com";

// Shorten the original URL
$shortenedURL = $urlShortener->shortenURL($originalURL);

echo "Shortened URL: http://yourdomain.com/$shortenedURL";
?>

<?php
 include 'URLShortener.php';


// Example usage
$servername = "localhost"; // Database server name
$username = "username"; // Database username
$password = "password"; // Database password
$database = "database_name"; // Database name

// Create an instance of the URLShortener class with the database connection details
$urlShortener = new URLShortener($servername, $username, $password, $database);

// Original URL to be shortened
$originalURL = "http://some-other-domain.com";

// Shorten the original URL using the shortenURL method of the URLShortener class
$shortenedURL = $urlShortener->shortenURL($originalURL);

// Display the shortened URL
echo "Shortened URL: http://yourdomain.com/$shortenedURL";

?>

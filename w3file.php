<?php
$servername = "localhost";
$username = "user";
$password = "tgCTG8jj9Ab8UuVj";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

echo "Connected successfully";
?>

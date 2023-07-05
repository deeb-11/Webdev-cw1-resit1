-- Create a table to store user accounts
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insert a sample user account
INSERT INTO users (username, password) VALUES ('exampleuser', 'examplepassword');

-- Login operation
SELECT COUNT(*) AS count FROM users WHERE username = 'exampleuser' AND password = 'examplepassword';

-- Account creation operation
INSERT INTO users (username, password) VALUES ('newuser', 'newpassword');


<?php
// MySQL database configuration
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Create a new MySQLi instance
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Perform database operations here

// Close the connection
$conn->close();
?>


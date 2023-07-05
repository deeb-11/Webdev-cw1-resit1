<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $username = $_POST["newUsername"];
    $password = $_POST["newPassword"];

    // Validate and process the data (you can add more validation as per your requirements)
    if (empty($username) || empty($password)) {
        // Display an error message if any field is empty
        $errorMessage = "Please fill in all the fields.";
    } else {
        // Connect to the database (replace with your database credentials)
        $mysqli = new mysqli("localhost", "username", "password", "database_name");
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        // Prepare the insert statement
        $stmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);

        // Execute the statement
        if ($stmt->execute()) {
            $successMessage = "Account created successfully!";
        } else {
            $errorMessage = "Error creating account: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $mysqli->close();
    }
}
?>


<?php
session_start(); // Start a session for user authentication

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate and process the data (you can add more validation as per your requirements)
    if (empty($username) || empty($password)) {
        // Display an error message if any field is empty
        $errorMessage = "Please fill in all the fields.";
    } else {
        // Connect to the database 
        $conn = new mysqli("localhost", "username", "password", "pizzastore");

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare the SQL statement to check the username and password against the database records
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a matching user is found
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $row["password"])) {
                // Password is correct, log in the user
                $_SESSION["username"] = $row["username"];
                $_SESSION["user_id"] = $row["id"];

                // Redirect to the home page or a dashboard page
                header("Location: index.html");
                exit();
            } else {
                // Invalid password
                $errorMessage = "Invalid username or password.";
            }
        } else {
            // User not found
            $errorMessage = "Invalid username or password.";
        }

        // Close the prepared statement and database connection
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($errorMessage)) : ?>
            <div class="error-message"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Log In">
            </div>
        </form>
        <p>Don't have an account? <a href="create_account.html">Create one</a>.</p>
    </div>
</body>
</html>

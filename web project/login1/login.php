<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "farmtrading";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Retrieve the user's hashed password from the database
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    $stmt->close();

    // Verify the password
    if (password_verify($password, $hashedPassword)) {
        // Login successful, redirect to a new page
        header("Location: /web project/product/product-list.html");
        exit(); // Make sure to exit to stop further execution
    } else {
        // Incorrect password, display alert
        echo "<script>alert('Invalid email or password.');</script>";
        // header("Location: /web project/login1/loginpage.html");
        exit();
    }
}

// Close the database connection
$conn->close();
?>
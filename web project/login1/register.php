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

// Process registration form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password for security

    // SQL query to insert user data into the database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful, redirect to a new page
        header("Location:\web project\product\product-list.html"); // Replace "success.php" with the actual URL of your success page
        exit(); // Make sure to exit to stop further execution
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
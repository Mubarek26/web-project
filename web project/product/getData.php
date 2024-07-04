<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmtrading";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT * FROM milk_products";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Assuming 'productImage' is a BLOB column
        $row['productImage'] = base64_encode($row['productImage']);
        $data[] = $row;
    }
}

// Close connection
$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
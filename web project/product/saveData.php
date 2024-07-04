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

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data (add more validation as needed)
    $fullName = mysqli_real_escape_string($conn, $_POST["Name"]);
    $productName = mysqli_real_escape_string($conn, $_POST["productName"]);
    $quantityAvailable = intval($_POST["quantityAvailable"]);
    $fatContent = floatval($_POST["fatContent"]);
    $packagingType = mysqli_real_escape_string($conn, $_POST["packagingType"]);
    $pricePerLiter = floatval($_POST["pricePerLiter"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);
    $availabilityStatus = mysqli_real_escape_string($conn, $_POST["availabilityStatus"]);

    // File upload handling
    $productImageData = file_get_contents($_FILES["productImage"]["tmp_name"]);
    $productImageData = base64_encode($productImageData);

    // Insert data into the database using prepared statement
    $sql = "INSERT INTO milk_products (FullName, ProductName, QuantityAvailable, FatContent, PackagingType, PricePerLiter, ProductImage, Location, AvailabilityStatus)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiddssss", $fullName, $productName, $quantityAvailable, $fatContent, $packagingType, $pricePerLiter, $productImageData, $location, $availabilityStatus);

    if ($stmt->execute()) {
        echo "Record inserted successfully";
        header("Location: product-list.html");
         exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
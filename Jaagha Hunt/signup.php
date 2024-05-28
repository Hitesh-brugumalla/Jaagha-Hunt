<?php
// Configuration for the database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "data_warehouse";

// Create a new database if it doesn't exist
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql) === FALSE) {
    die("Error creating database: " . $conn->error);
}

$conn->close();

// Connect to the database
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the table exists, create it if not
$table = "farmers";
$sql = "CREATE TABLE IF NOT EXISTS $table (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    location VARCHAR(100) NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    address VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === FALSE) {
    die("Error creating table: " . $conn->error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $first_name = $_POST["firstName"];
    $last_name = $_POST["lastName"];
    $gender = $_POST["gender"];
    $location = $_POST["location"];
    $phone_number = $_POST["phoneNumber"];
    $address = $_POST["address"];
    $password = $_POST["password"];

    // Insert data into the table
    $sql = "INSERT INTO $table (first_name, last_name, gender, location, phone_number, address, password)
            VALUES ('$first_name', '$last_name', '$gender', '$location', '$phone_number', '$address', '$password')";
    if ($conn->query($sql) === TRUE) {
        // Redirect to signup.html
    header("Location: calender.html");
    exit();
    } else {
        echo "Error storing data: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

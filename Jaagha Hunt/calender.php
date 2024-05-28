<?php
// Configuration for the database connection
$servername = "localhost";
$username = "root";
$password = "";

// Create a new database if it doesn't exist
$database = "data_warehouse";
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
$table = "bookings";
$sql = "CREATE TABLE IF NOT EXISTS $table (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    selected_date DATE NOT NULL
)";
if ($conn->query($sql) === FALSE) {
    die("Error creating table: " . $conn->error);
}

// Close the database connection
$conn->close();
?>

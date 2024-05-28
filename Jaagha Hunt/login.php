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

// Check if the required table exists, create it if not
$table = "users";
$sql = "CREATE TABLE IF NOT EXISTS $table (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  phone_number VARCHAR(15) NOT NULL
)";
if ($conn->query($sql) === FALSE) {
  die("Error creating table: " . $conn->error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Retrieve the phone number from the form
  $phone_number = $_POST["PhoneNumber"];

  // Insert the phone number into the database
  $sql = "INSERT INTO $table (phone_number) VALUES ('$phone_number')";
  if ($conn->query($sql) === TRUE) {
    // Redirect to signup.html
    header("Location: signup.html");
    exit();
  } else {
    echo "Error storing data: " . $conn->error;
  }
}

// Close the database connection
$conn->close();
?>

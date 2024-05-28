<!DOCTYPE html>
<html>
<head>
  <title>Data Warehouse Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url(https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80);
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .container h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .form-group input[type="text"],
    .form-group input[type="password"] {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    .form-group input[type="submit"] {
      width: 100%;
      padding: 8px;
      border: none;
      border-radius: 3px;
      background-color: #4caf50;
      color: #fff;
      cursor: pointer;
    }

    .form-group input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
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

  <div class="container">
    <h2>Data Warehouse Login</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="form-group">
        <label for="PhoneNumber">PhoneNumber:</label>
        <input type="text" id="PhoneNumber" name="PhoneNumber" required>
      </div>
      <div class="form-group">
        <input type="submit" value="Login">
      </div>
    </form>
  </div>
</body>
</html>

<?php

// Max: Connects PHP with our database.

$dbservername = "localhost";
$dbusername = "REDACTED";
$dbpassword = "REDACTED";
$dbname = "REDACTED";

// Create a new connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// echo "Connected successfully";
?>

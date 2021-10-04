<?php
$servername = "localhost";
$username = "staj";
$password = "zqmi.LMUnTFJ2XD)";
$dbname = "staj";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
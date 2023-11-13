<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName='notes';

// Create connection
$db = mysqli_connect($servername, $username, $password, $dbName);

// Check connection
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected";
?> 
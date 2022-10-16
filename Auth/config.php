<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e_learning";
 
/* Attempt to connect to MySQL database */
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>
<?php
include 'Auth/config.php';

$id= $_POST['id'];
$listid = $_POST["listid"];


GLOBAL $conn;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$qry=mysqli_query($conn,"DELETE FROM word where id='".$id."'");

?>
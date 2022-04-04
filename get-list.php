<?php 
session_start();

include 'Auth/config.php';
include 'function.php';

checkLogin();

GLOBAL $conn;

$id = $_GET['id'];

$queryWord = "SELECT * FROM word WHERE list_id = $id";
$result = mysqli_query($conn, $queryWord);
$words = array();

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
        $words[] = $row; 
        }
        echo json_encode($words);
    }
}
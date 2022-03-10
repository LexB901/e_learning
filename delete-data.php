<?php
if(isset($_POST['delAddedWord']))
{
  include 'Auth/config.php';

  $wordid = $_POST["wordId"];

  GLOBAL $conn;

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "DELETE FROM word WHERE id=$wordid";

  if ($conn->query($sql) === TRUE) {
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>
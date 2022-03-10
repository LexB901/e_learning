<?php

include 'Auth/config.php';

$listid = $_POST["listid"];
$wordsNL = $_POST["word-nl"];
$wordsEN = $_POST["word-en"];

GLOBAL $conn;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

foreach (array_combine($wordsNL, $wordsEN) as $wordNL => $wordEN) {
    if (strlen(!empty($wordNL)) > 0 && strlen(!empty($wordEN)) > 0) {            
        $sql = "INSERT INTO word (list_id, word_nl, word_en) VALUES ('$listid', '$wordNL', '$wordEN')";
    } elseif(empty($wordNL) || empty($wordEN)) {
        continue;
    }
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Versturen van de data is mislukt!";
    }
}

?>
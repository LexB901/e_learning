<?php

function checkLogin() {
    if (isset($_SESSION['loggedin'])) {
    } else {
        header("Location: Auth/login.php");
    }
}

function addWords() {

    include 'Auth/config.php';

    $listid = $_POST["listid"];
    $wordsNL = $_POST["word-nl"];
    $wordsEN = $_POST["word-en"];

    GLOBAL $conn;

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql2 = "DELETE FROM word WHERE list_id=$listid";

    if ($conn->query($sql2) === TRUE) {
    } else {
        echo "Versturen van de data is mislukt!";
    }

    foreach (array_combine($wordsNL, $wordsEN) as $wordNL => $wordEN) {
        if (!empty($wordNL) && !empty($wordEN)) {
            $sql = "INSERT INTO word VALUES (DEFAULT, '$listid', '$wordNL', '$wordEN')";
        } else {
            continue;
        }
        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Versturen van de data is mislukt!";
        }
    }
};

function newList() {
    include 'Auth/config.php';

    $userid =($_SESSION["id"]);
    $listname = $_POST["list-name"];
     
    GLOBAL $conn;

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO list (name, user_id) VALUES ('$listname', '$userid')";
    
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
};

function deleteList() {
    include 'Auth/config.php';

    $listid = $_POST["rowid"];

    GLOBAL $conn;
    
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $word = "DELETE FROM word WHERE list_id=$listid";
    if ($conn->query($word) === TRUE) {
    } else {
        echo "Error: " . $word . "<br>" . $conn->error;
    }
    
    $sql = "DELETE FROM list WHERE id=$listid";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
};

?>
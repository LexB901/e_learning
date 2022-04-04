<?php
session_start();

include 'Auth/config.php';
include 'function.php';

checkLogin();

GLOBAL $conn;

$listname = $_GET["listname"];
$listid = $_GET["id"];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
    <style>
        .lijst-div {
            margin-top: 0;
        }

        body {
            font: 16px sans-serif; 
        }

        .line-height {
            line-height: 22px;
            margin-bottom: 0px;
        }

        .word-list {
            display: flex;
            flex-direction: column;
        }

        .input-form {
            display: flex;
            flex-direction: column;
        }

        h2.my-5 {
            margin-bottom: 1rem !IMPORTANT;
        }

        h4.my-5 {
            margin-bottom: 0 !IMPORTANT;
            margin-top: 0 !IMPORTANT;
        }

        .flex-column {
            display: flex;
            flex-direction: column;
        }

        .display-none {
            display: none;
        }
    </style>
  
</head>

<body>
    <h6>
        <a class="btn btn-warning m-3" href="welcome.php">terug</a>
    </h6>
    <div id="container">
        <div style="margin-top: 0px;" class="lijst-div">
            <img id="NLEN" class="trans-active display-none" onclick="ChangeTransNLENPrac()" width="160px" height="30px" src="img/english-dutch.png" alt="NL -> EN">
            <img id="ENNL" class="trans-inactive" onclick="ChangeTransENNLPrac()" width="160px" height="30px" src="img/dutch-english.png" alt="EN -> NL">
        </div>
        <div class="container">
            <div class="flex-column lijst-div">
                <h2 class="my-5"><?php echo $listname; ?></h2>
                <h4 class="my-5">Let op de hoofdletters</h4>
            </div>
            <div id="nl-en">
                <div class="lijst-div" style="margin-top: 2rem; align-items: start;">
                    <div style="display: flex;">
                        <div class="word-list">
                            <p id="nlword-nl" class="input-txt-ctr wordListStyle"></p>
                        </div>
                        <div style="margin-left: 2rem;">
                            <input type="text" id="nlword-en" class="input-txt-ctr wordListStyle marg-bottom-1r" />
                        </div>
                    </div>
                </div>
                <div style="text-align: center;" id="score"></div>
            </div>
            <div id="en-nl" class="display-none">
                <div class="lijst-div" style="margin-top: 2rem; align-items: start;">
                    <div style="display: flex;">
                        <div class="word-list">
                            <p id="enword-en" class="input-txt-ctr wordListStyle"></p>
                        </div>
                        <div style="margin-left: 2rem;">
                            <input type="text" id="enword-nl" class="input-txt-ctr wordListStyle marg-bottom-1r" />
                        </div>
                    </div>
                </div>
                <div style="text-align: center;" id="score2"></div>
            </div>
            <div class="lijst-div">
                <h4 id="score" class="my-5"></h4>
            </div>
            <div class="button-check-div">
                <input id="next-question" form="input-form" style="width: 175px; margin-bottom: 3rem" class="btn btn-warning" value="Volgende">
                <input id="next-question2" form="input-form" style="width: 175px; margin-bottom: 3rem" class="btn btn-warning display-none" value="Volgende">
            </div>
        </div>
    </div>
    <div class="display-none" style="text-align: center;margin-top: 15rem;" id="no-word-err">
        <h2><?php echo $listname; ?></h2>
        <h4>Er zijn geen woorden gevonden :/</h4>
        <h6>Klik hier om woorden toe te voegen aan de lijst</h6>
        <form method="get" action="edit-list.php">
            <input type="hidden" name="listid" value='<?php
            echo $listid
            ?>'>
            <input type="hidden" name="listname" value='<?php
            echo $listname
            ?>'>
            <input type="submit" name="editList" value="Bewerken" class="btn btn-primary line-height-1">
        </form>
    </div>
</body>

</body>

</html>
<?php 
session_start();    

include 'Auth/config.php';

error_reporting(E_ERROR | E_PARSE);

GLOBAL $conn;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$listid = $_POST["listid"];
$listname = $_POST["listname"];

$getWords = "SELECT * FROM word WHERE list_id=$listid";
$result = mysqli_query($conn, $getWords);  
$result2 = mysqli_query($conn, $getWords);
$result3 = mysqli_query($conn, $getWords);  
$result4 = mysqli_query($conn, $getWords);
$result5 = mysqli_query($conn, $getWords);

if(array_key_exists('checkWordEN', $_POST)) {
    checkWordEN();
}
if(array_key_exists('checkWordNL', $_POST)) {
    checkWordNL();
}

$getTotal = "SELECT id FROM word WHERE list_id = $listid";
if ($newTotal = mysqli_query($conn, $getTotal)) {
    $total = mysqli_num_rows($newTotal);
}

$total = $total;
$score = 0;

function checkWordEN() {
    include 'Auth/config.php';

    $wordsID = $_POST["wordid"];
    $listid = $_POST["listid"];
    $wordsNL = $_POST["word-nl"];
    $wordsEN = $_POST["word-en"];

    GLOBAL $conn;
    
    $total = "";
    $score = 0;

    $getTotal = "SELECT id FROM word WHERE list_id = $listid";
    if ($newTotal = mysqli_query($conn, $getTotal)) {
        $total = mysqli_num_rows($newTotal);
    }

    global $score;

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    if (isset($wordsEN) || (!empty($wordsEN))) {
        foreach ($wordsEN as $wordEN) {
            foreach ($wordsID as $wordID) {
                $checkWord = "SELECT word_en FROM word WHERE id=$wordID";
                $newResult = mysqli_query($conn, $checkWord);    
                while ($row = $newResult->fetch_assoc()) {
                    if ($row["word_en"] == $wordEN) {
                        $score += 1;
                    } elseif($row["word_en"] != $wordEN) {
                        $score += 0;
                    }
                }
            }
        }
        echo "<script>alert('Je hebt ".$score."/".$total." goed!')</script>";
    }
}

function checkWordNL() {
    include 'Auth/config.php';

    $wordsID = $_POST["wordid"];
    $listid = $_POST["listid"];
    $wordsNL = $_POST["word-nl"];
    $wordsEN = $_POST["word-en"];

    GLOBAL $conn;
    
    $total = "";
    $score = 0;

    $getTotal = "SELECT id FROM word WHERE list_id = $listid";
    if ($newTotal = mysqli_query($conn, $getTotal)) {
        $total = mysqli_num_rows($newTotal);
    }

    global $score;

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    if (isset($wordsNL) || (!empty($wordsNL))) {
        foreach ($wordsNL as $wordNL) {
            foreach ($wordsID as $wordID) {
                $checkWord = "SELECT word_nl FROM word WHERE id=$wordID";
                $newResult = mysqli_query($conn, $checkWord);    
                while ($row = $newResult->fetch_assoc()) {
                    if ($row["word_nl"] == $wordNL) {
                        $score += 1;
                    } elseif($row["word_nl"] != $wordNL) {
                        $score += 0;
                    }
                }
            }
        }
        echo "<script>alert('Je hebt ".$score."/".$total." goed!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Oefenen</title>
    <style>
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
            /* flex-direction: column; */
        }
        .right-ans {
            background-color: lightgreen;
        }
        .trans-active {
            color: #ffc107;
        }

        .trans-active:hover {
            cursor: pointer;
            color: #ffc107;
        }

        .trans-inactive {
            color: red;
        }

        .trans-inactive:hover {
            cursor: pointer;
            color: red;
        }

        .display-none {
            display: none;
        }
        
    </style>
    <script>
        function ChangeTransNLEN() {
            $( "#NLEN" ).removeClass( "trans-inactive" ).addClass( "trans-active" );
            $( "#ENNL" ).removeClass( "trans-active" ).addClass( "trans-inactive" );
            $( "#nl-en" ).removeClass( "display-none" );
            $( "#en-nl" ).addClass( "display-none" );
            $( "#score" ).addClass( "display-none" ).removeClass( "display-none" );
        }

        function ChangeTransENNL() {
            $( "#ENNL" ).removeClass( "trans-inactive" ).addClass( "trans-active" );
            $( "#NLEN" ).removeClass( "trans-active" ).addClass( "trans-inactive" );
            $( "#en-nl" ).removeClass( "display-none" );
            $( "#nl-en" ).addClass( "display-none" );
            $( "#score" ).addClass( "display-none" ).removeClass( "display-none" );
        }
    </script>
</head>
<body>
<h6>
    <a class="btn btn-warning m-3" href="welcome.php">terug</a>
</h6>
<div style="margin-top: 0px;" class="lijst-div">
    <a id="NLEN" class="trans-active" onclick="ChangeTransNLEN()">NL -> EN</a>
    <a style="width: 2rem;" href=""></a>
    <a id="ENNL" class="trans-inactive" onclick="ChangeTransENNL()">EN -> NL</a>
</div>
<div>
    <h4 class="lijst-div"><?php echo $listname ?></h4>
</div>
           
    <div id="nl-en" class="lijst-div" style="margin-top: 2rem; align-items: start;">
        <form id="input-form" class="input-form" method="post">
            <div style="margin-right: 2rem; text-align: right;">
                <div class="word-list">
                    <input type='hidden' name='listid' value='<?php echo $listid;?>'>
                    <input type='hidden' name='listname' value='<?php echo $listname;?>'>
                    <?php 
                        while ($row = mysqli_fetch_array($result)) { ?>
                            <input type='hidden' name='wordid[]' value='<?php echo $row["id"];?>'>
                            <input type='hidden' name='word-nl[]' value='<?php echo $row["word_nl"];?>'>

                        <tr>
                            <div id="divWordNL">
                                <p class="line-height" ><?php echo $row["word_nl"]; ?></p>
                            </div>
                        </tr>
                    <?php 
                        }
                    ?>            
                </div>                
            </div>       
            
            <div style="margin-left: 2rem; display: flex; flex-direction: column;">
                    <?php 
                        while ($row = mysqli_fetch_array($result2)) {   
                    ?>
                            <input style="height: 22px; text-align: center;" type="text" id="wordCheck<?php echo $i++;?>" name="word-en[]">
                    <?php 
                        }
                    ?>  
                    <input type="submit" value="Nakijken" name="checkWordEN">
            </div> 
        </form>
    </div>

    <div id="en-nl" class="lijst-div display-none" style="margin-top: 2rem; align-items: start;">
        <form id="input-form2" class="input-form" method="post">
            <div style="margin-right: 2rem; text-align: right;">
                <div class="word-list">
                    <input type='hidden' name='listid' value='<?php echo $listid;?>'>
                    <input type='hidden' name='listname' value='<?php echo $listname;?>'>
                    <?php 
                        while ($row = mysqli_fetch_array($result3)) { ?>
                            <input type='hidden' name='wordid[]' value='<?php echo $row["id"];?>'>
                            <input type='hidden' name='word-en[]' value='<?php echo $row["word_en"];?>'>

                        <tr>
                            <div id="divWordEN">
                                <p class="line-height" ><?php echo $row["word_en"]; ?></p>
                            </div>
                        </tr>
                    <?php 
                        }
                    ?>            
                </div>                
            </div>       
            
            <div style="margin-left: 2rem; display: flex; flex-direction: column;">
                    <?php 
                        while ($row = mysqli_fetch_array($result4)) {   
                    ?>
                            <input style="height: 22px; text-align: center;" type="text" id="wordCheck<?php echo $i++;?>" name="word-nl[]">
                    <?php 
                        }
                    ?>  
                    <input type="submit" value="Nakijken" name="checkWordNL">
            </div> 
        </form>
    </div>

</body>
</html>
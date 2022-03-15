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
                        $score = $score;
                    }
                }
            }
        }
       
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

<a href="get-data.php">get-data</a>

<body>
<h6>
    <a href="welcome.php">terug</a>
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
                            <input style="height: 22px;" type="text" id="wordCheck<?php echo $i++;?>" name="word-en[]">
                    <?php 
                        }
                    ?>  
                    <input type="submit" value="Nakijken" name="checkWordEN">
            </div> 
        </form>
    </div>
    <div style="margin-top: 100px;" class="lijst-div">
        <h4 id="score" class="my-5">
            <?php
                echo "Je hebt ".$score."/".$total." goed!";
            ?>
        </h4>
    </div>

    <div id="en-nl" class="lijst-div display-none" style="margin-top: 2rem; align-items: start;">
        <div style="margin-right: 2rem; text-align: right;">
            <div class="word-list">
                <?php 
                    while ($row = mysqli_fetch_array($result3)) {
                ?>
                    <tr>
                        <p class="line-height"><?php echo $row["word_en"]; ?></p>
                    </tr>
                <?php 
                    }
                ?>            
            </div>                
        </div>       
        
        <div style="margin-left: 2rem;">
            <form id="input-form" class="input-form" method="post">
                <?php 
                    for ($i=50;$i<100;$i++) {
                        // for ($x=50;$x<100;$x++) {
                            while ($row = mysqli_fetch_array($result4)) {   
                ?>
                    <input type="text" id="wordCheck<?php echo $i++;?>" name='<?php echo $row["id"]; ?>'>
                <?php 
                            }
                        // }
                    }
                ?>  

                <input name="checkTotal" type="button" value="Nakijken">
            </form>
            <script>
                function AnsCheck() {
                    document.getElementById("score").innerHTML = "Je hebt " + score + "/10 woorden goed!";   
                }

                let score = 0;
                $('#wordCheck50').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Hello") {
                        if ($("#wordCheck50").hasClass("right-ans")) {
                            score = score;
                        } else {
                            $("#wordCheck50").addClass("right-ans");
                            score += 1;
                        }
                    } 
                });
                $('#wordCheck51').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Bye") {
                        if ($("#wordCheck51").hasClass("right-ans")) {
                            score = score;
                        } else {
                            $("#wordCheck51").addClass("right-ans");
                            score += 1;
                        }
                    }
                });
                $('#wordCheck52').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Me") {
                        if ($("#wordCheck52").hasClass("right-ans")) {
                            score = score;
                        } else {
                            $("#wordCheck52").addClass("right-ans");
                            score += 1;
                        }
                    }
                });
                $('#wordCheck53').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "You") {
                        if ($("#wordCheck53").hasClass("right-ans")) {
                            score = score;
                        } else {
                            $("#wordCheck53").addClass("right-ans");
                            score += 1;
                        }
                    }
                });
                $('#wordCheck54').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "City") {
                        if ($("#wordCheck54").hasClass("right-ans")) {
                            score = score;
                        } else {
                            $("#wordCheck54").addClass("right-ans");
                            score += 1;
                        }
                    }
                });
                $('#wordCheck55').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Village") {
                        if ($("#wordCheck55").hasClass("right-ans")) {
                            score = score;
                        } else {
                            $("#wordCheck55").addClass("right-ans");
                            score += 1;
                        }
                    }
                });
                $('#wordCheck56').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Apple") {
                        if ($("#wordCheck56").hasClass("right-ans")) {
                            score = score;
                        } else {
                            $("#wordCheck56").addClass("right-ans");
                            score += 1;
                        }
                    }
                });
                $('#wordCheck57').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Banana") {
                        if ($("#wordCheck57").hasClass("right-ans")) {
                            score = score;
                        } else {
                            $("#wordCheck57").addClass("right-ans");
                            score += 1;
                        }
                    }
                });
                $('#wordCheck58').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "House") {
                        if ($("#wordCheck58").hasClass("right-ans")) {
                            score = score;
                        } else {
                            $("#wordCheck58").addClass("right-ans");
                            score += 1;
                        }
                    }
                });
                $('#wordCheck59').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Room") {
                        if ($("#wordCheck59").hasClass("right-ans")) {
                            score = score;
                        } else {
                            $("#wordCheck59").addClass("right-ans");
                            score += 1;
                        }
                    }
                });
                
            </script>
        </div>       
    </div>
    <div style="margin-top: 100px;" class="lijst-div">
        <h4 id="score" class="my-5"></h4>
    </div>
</body>
</html>
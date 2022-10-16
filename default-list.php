<?php 
session_start(); 

include 'function.php';

checkLogin();

$wordListNL = ['Een' => 'een', 'Twee', 'Drie', 'Vier', 'Vijf', 'Zes', 'Zeven', 'Acht', 'Negen', 'Tien'];
$wordListEN = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
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
            flex-direction: column;
        }

        .lijst-div {
            margin-top: 0;
        }

        h4.my-5 {
            margin-top: 0px !IMPORTANT;
        }

        h2.my-5 {
            margin-bottom: 0px !IMPORTANT;
        }
        

        
    </style>
</head>
<body>
<h6>
    <a class="btn btn-warning m-3" href="welcome.php">terug</a>
</h6>
<div style="margin-top: 0px;" class="lijst-div">
    <img id="NLEN" class="trans-active display-none" onclick="ChangeTransNLEN()" width="160px" height="30px" src="img/english-dutch.png" alt="NL -> EN">
    <img id="ENNL" class="trans-inactive" onclick="ChangeTransENNL()" width="160px" height="30px" src="img/dutch-english.png" alt="EN -> NL">
</div>

    <div class="lijst-div">
        <h2 class="my-5">Zet hem op, veel succes!</h2>
    </div>

    <div id="nl-en">
        <div class="lijst-div" style="margin-top: 2rem; align-items: start;">
            <div style="margin-right: 2rem; text-align: right;">
                <div class="word-list">
                <?php foreach($wordListNL as $key=>$value): ?>
                    <p class="input-txt-ctr wordListStyle"><?= $value; ?></p>
                <?php endforeach; ?>
                </div>
            </div>
            <div style="margin-left: 2rem;">
                <form id="input-form" class="input-form" method="post">
                <?php 
                    for($x = 0; $x <= 9; $x++) {
                        echo ' <input class="input-txt-ctr wordListStyle marg-bottom-1r" type="text" id="wordCheck'.$x.'">';
                    }
                    ?>
                    <br>

                </form>
                <script>
                    let wordListEN = ["One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten"];
                    let wordListEN2 = ["one", "two", "three", "four", "fve", "six", "seven", "eight", "nine", "ten"];

                    let score = 0;
                    for (let i = 0; i < 10; i++) {
                        $('#wordCheck'+i).keyup(function() {
                            var newInput = this.value;
                            if (newInput == wordListEN[i] || newInput == wordListEN2[i]) {
                                if ($("#wordCheck"+i).hasClass("right-ans")) {
                                    score = score;
                                } else {
                                    $("#wordCheck"+i).addClass("right-ans");
                                    score += 1;
                                }

                                $( "#score" ).show().text("Je hebt " + score + "/10 woorden goed!")
                            }
                        });
                    }
                </script>
            </div>
        </div>
        <div class="lijst-div">
            <h4 id="score" class="my-5"></h4>
        </div>
        <div class="button-check-div">
            <input form="input-form" style="width: 175px; margin-bottom: 3rem" class="btn btn-primary" onclick="ResetForm()" type="reset" value="Opnieuw proberen">
        </div>
    </div>

    <div id="en-nl" class="display-none">
        <div class="lijst-div" style="margin-top: 2rem; align-items: start;">
            <div style="margin-right: 2rem; text-align: right;">
                <div class="word-list">
                <?php foreach($wordListEN as $key=>$value): ?>
                    <p class="input-txt-ctr wordListStyle"><?= $value; ?></p>
                <?php endforeach; ?>
                </div>
            </div>
            
            <div style="margin-left: 2rem;">
                <form id="input-form2" class="input-form" method="post">
                    <?php 
                    for($z = 0; $z <= 9; $z++) {
                        echo ' <input class="input-txt-ctr wordListStyle marg-bottom-1r" type="text" id="wordCheck1'.$z.'">';
                    }
                    ?>
                   <br>
                </form>
                <script>
                    let wordListNL = ["Een", "Twee", "Drie", "Vier", "Vijf", "Zes", "Zeven", "Acht", "Negen", "Tien"];
                    let wordListNL2 = ["een", "twee", "drie", "vier", "vijf", "zes", "zeven", "acht", "negen", "tien"];

                    let score2 = 0;
                    for (let g = 0; g < 10 ; g++) {
                        $('#wordCheck1'+g).keyup(function() {
                            let newInput = this.value;
                            if (newInput == wordListNL[g] || newInput == wordListNL2[g]) {
                                if ($("#wordCheck1"+g).hasClass("right-ans")) {
                                    score2 = score2;
                                } else {
                                    $("#wordCheck1"+g).addClass("right-ans");
                                    score2 += 1;
                                }
                                $( "#score2" ).show().text("Je hebt " + score2 + "/10 woorden goed!")
                            }
                        });
                    }
                </script>
            </div>
        </div>
        <div class="lijst-div">
            <h4 id="score2" class="my-5"></h4>
        </div>
        <div class="button-check-div">
            <input form="input-form2" style="width: 175px; margin-bottom: 3rem" class="btn btn-primary" onclick="ResetForm2()" type="reset" value="Opnieuw proberen">
        </div>
    </div>

    
</body>
</html>
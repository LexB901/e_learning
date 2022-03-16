<?php 
session_start(); 

$wordListNL = ['Hallo', 'Doei', 'Ik', 'Jij', 'Stad', 'Dorp', 'Appel', 'Banaan', 'Huis', 'Kamer'];
$wordListEN = ['Hello', 'Bye', 'Me', 'You', 'City', 'Village', 'Apple', 'Banana', 'House', 'Room'];


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
            flex-direction: column;
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
            $( "#score" ).addClass( "display-none" );

        }

        function ChangeTransENNL() {
            $( "#ENNL" ).removeClass( "trans-inactive" ).addClass( "trans-active" );
            $( "#NLEN" ).removeClass( "trans-active" ).addClass( "trans-inactive" );
            $( "#en-nl" ).removeClass( "display-none" );
            $( "#nl-en" ).addClass( "display-none" );
            $( "#score" ).addClass( "display-none" );

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

    <div class="lijst-div">
        <h2 class="my-5">Let op de hoofdletters!</h2>
    </div>

    <div id="nl-en" class="lijst-div" style="margin-top: 2rem; align-items: start;">
        <div style="margin-right: 2rem; text-align: right;">
            <div class="word-list">
                
                <?php foreach($wordListNL as $key=>$value): ?>
                    <tr>
                        <p class="line-height"><?= $value; ?></p>
                    </tr>
                <?php endforeach; ?>
                
            </div>
        </div>
        
        <div style="margin-left: 2rem;">
            <form id="input-form" class="input-form" method="post">
                <input type="text" id="wordCheck0" name="word0">
                <input type="text" id="wordCheck1" name="word1">
                <input type="text" id="wordCheck2" name="word2">
                <input type="text" id="wordCheck3" name="word3">
                <input type="text" id="wordCheck4" name="word4">
                <input type="text" id="wordCheck5" name="word5">
                <input type="text" id="wordCheck6" name="word6">
                <input type="text" id="wordCheck7" name="word7">
                <input type="text" id="wordCheck8" name="word8">
                <input type="text" id="wordCheck9" name="word9">
                <br>
                <input onclick="AnsCheck()" type="button" value="Nakijken">
                <input onclick="ResetForm()" type="button" value="Opnieuw proberen">

            </form>
            <script>
                function ResetForm() {
                    reload = location.reload();
                }
                function AnsCheck() {
                    let removeClass = document.getElementById("score");
                    removeClass.classList.remove("display-none");
                    document.getElementById("score").innerHTML = "Je hebt " + score + "/10 woorden goed!";   
                }

                let score = 0;
                $('#wordCheck0').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Hello") {
                        if ($("#wordCheck0").hasClass("right-ans")) {
                            score = score;
                        } else {
                            $("#wordCheck0").addClass("right-ans");
                            score += 1;
                        }
                    } 
                });
                $('#wordCheck1').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Bye") {
                        if ($("#wordCheck1").hasClass("right-ans")) {
                            score = score;
                        } else {
                            $("#wordCheck1").addClass("right-ans");
                            score += 1;
                        }
                    }
                });
                $('#wordCheck2').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Me") {
                        if ($("#wordCheck2").hasClass("right-ans")) {
                            score = score;
                        } else {
                            $("#wordCheck2").addClass("right-ans");
                            score += 1;
                        }
                    }
                });
                $('#wordCheck3').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "You") {
                        if ($("#wordCheck3").hasClass("right-ans")) {
                            score = score;
                        } else {
                            $("#wordCheck3").addClass("right-ans");
                            score += 1;
                        }
                    }
                });
                $('#wordCheck4').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "City") {
                        if ($("#wordCheck4").hasClass("right-ans")) {
                            score = score;
                        } else {
                            $("#wordCheck4").addClass("right-ans");
                            score += 1;
                        }
                    }
                });
                $('#wordCheck5').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Village") {
                        if ($("#wordCheck5").hasClass("right-ans")) {
                            score = score;
                        } else {
                            $("#wordCheck5").addClass("right-ans");
                            score += 1;
                        }
                    }
                });
                $('#wordCheck6').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Apple") {
                        if ($("#wordCheck6").hasClass("right-ans")) {
                            score = score;
                        } else {
                            $("#wordCheck6").addClass("right-ans");
                            score += 1;
                        }
                    }
                });
                $('#wordCheck7').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Banana") {
                        if ($("#wordCheck7").hasClass("right-ans")) {
                            score = score;
                        } else {
                            $("#wordCheck7").addClass("right-ans");
                            score += 1;
                        }
                    }
                });
                $('#wordCheck8').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "House") {
                        if ($("#wordCheck8").hasClass("right-ans")) {
                            score = score;
                        } else {
                            $("#wordCheck8").addClass("right-ans");
                            score += 1;
                        }
                    }
                });
                $('#wordCheck9').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Room") {
                        if ($("#wordCheck9").hasClass("right-ans")) {
                            score = score;
                        } else {
                            $("#wordCheck9").addClass("right-ans");
                            score += 1;
                        }
                    }
                });
                
            </script>

        </div>
        
    </div>

    <div id="en-nl" class="lijst-div display-none" style="margin-top: 2rem; align-items: start;">
        <div style="margin-right: 2rem; text-align: right;">
            <div class="word-list">
                
                <?php foreach($wordListEN as $key=>$value): ?>
                    <tr>
                        <p class="line-height"><?= $value; ?></p>
                    </tr>
                <?php endforeach; ?>
                
            </div>
        </div>
        
        <div style="margin-left: 2rem;">
            <form id="input-form2" class="input-form" method="post">
                <input type="text" id="wordCheck10" name="word10">
                <input type="text" id="wordCheck11" name="word11">
                <input type="text" id="wordCheck12" name="word12">
                <input type="text" id="wordCheck13" name="word13">
                <input type="text" id="wordCheck14" name="word14">
                <input type="text" id="wordCheck15" name="word15">
                <input type="text" id="wordCheck16" name="word16">
                <input type="text" id="wordCheck17" name="word17">
                <input type="text" id="wordCheck18" name="word18">
                <input type="text" id="wordCheck19" name="word19">
                <br>
                <input onclick="AnsCheck2()" type="button" value="Nakijken">
                <input onclick="ResetForm2()" type="button" value="Opnieuw proberen">
            </form>
            <script>
                function ResetForm2() {
                    document.getElementById("input-form2").reset();
                }
                function AnsCheck2() {
                    let removeClass2 = document.getElementById("score");
                    removeClass2.classList.remove("display-none");
                    document.getElementById("score").innerHTML = "Je hebt " + score2 + "/10 woorden goed!";   
                }

                let score2 = 0;
                $('#wordCheck10').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Hallo") {
                        if ($("#wordCheck10").hasClass("right-ans")) {
                            score2 = score2;
                        } else {
                            $("#wordCheck10").addClass("right-ans");
                            score2 += 1;
                        }
                    } 
                });
                $('#wordCheck11').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Doei") {
                        if ($("#wordCheck11").hasClass("right-ans")) {
                            score2 = score2;
                        } else {
                            $("#wordCheck11").addClass("right-ans");
                            score2 += 1;
                        }
                    }
                });
                $('#wordCheck12').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Ik") {
                        if ($("#wordCheck12").hasClass("right-ans")) {
                            score2 = score2;
                        } else {
                            $("#wordCheck12").addClass("right-ans");
                            score2 += 1;
                        }
                    }
                });
                $('#wordCheck13').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Jij") {
                        if ($("#wordCheck13").hasClass("right-ans")) {
                            score2 = score2;
                        } else {
                            $("#wordCheck13").addClass("right-ans");
                            score2 += 1;
                        }
                    }
                });
                $('#wordCheck14').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Stad") {
                        if ($("#wordCheck14").hasClass("right-ans")) {
                            score2 = score2;
                        } else {
                            $("#wordCheck14").addClass("right-ans");
                            score2 += 1;
                        }
                    }
                });
                $('#wordCheck15').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Dorp") {
                        if ($("#wordCheck15").hasClass("right-ans")) {
                            score2 = score2;
                        } else {
                            $("#wordCheck15").addClass("right-ans");
                            score2 += 1;
                        }
                    }
                });
                $('#wordCheck16').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Appel") {
                        if ($("#wordCheck16").hasClass("right-ans")) {
                            score2 = score2;
                        } else {
                            $("#wordCheck16").addClass("right-ans");
                            score2 += 1;
                        }
                    }
                });
                $('#wordCheck17').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Banaan") {
                        if ($("#wordCheck17").hasClass("right-ans")) {
                            score2 = score2;
                        } else {
                            $("#wordCheck17").addClass("right-ans");
                            score2 += 1;
                        }
                    }
                });
                $('#wordCheck18').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Huis") {
                        if ($("#wordCheck18").hasClass("right-ans")) {
                            score2 = score2;
                        } else {
                            $("#wordCheck18").addClass("right-ans");
                            score2 += 1;
                        }
                    }
                });
                $('#wordCheck19').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Kamer") {
                        if ($("#wordCheck19").hasClass("right-ans")) {
                            score2 = score2;
                        } else {
                            $("#wordCheck19").addClass("right-ans");
                            score2 += 1;
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
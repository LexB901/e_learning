<?php 
// error_reporting(E_ERROR | E_PARSE);
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
    <title>Oefenen</title>
    <style>
        body {
            font: 16px sans-serif; 
        }

        .line-height {
            line-height: 20px;
        }

        .word-list {
            display: flex;
            flex-direction: column;
        }

        .input-form {
            display: flex;
            flex-direction: column;
        }

        .geen-woord {
            background-color: white;
        }

        .correct {
            background-color: lightgreen;
        }

        .fout {
            background-color: red;
        }

        .right-ans {
            background-color: lightgreen;
        }
        .wrong-ans {
            background-color: #FF7F7F;
        }
        
    </style>
    <script>
        function checkForm(form)
        {
            if(this.name.value == "") {
            this.name.focus();
            return false;
            }
            if(this.email.value == "" || !this.valid_email.checked) {
            this.email.focus();
            return false;
            }
            if(this.age.value == "" || !this.valid_age.checked) {
            this.age.focus();
            return false;
            }
            alert("Success!  The form has been completed, validated and is ready to be submitted...");
            return false;
        }
    </script>
</head>
<body>
    <div class="lijst-div">
        <h2 class="my-5">Begin elk woord met een hoofdletter!</h2>
    </div>
    <div style="margin-top: 20px;" class="lijst-div">
        <h4  id="score" class="my-5"></h4>/10
    </div>
    <div class="lijst-div" style="margin-top: 2rem; align-items: start;">
        <div style="margin-right: 2rem; text-align: right;">
            <div class="word-list">
                <p>
                <?php foreach($wordListNL as $key=>$value): ?>
                    <tr>
                        <p class="line-height"><?= $value; ?></p>
                    </tr>
                <?php endforeach; ?>
                </p>
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
                <input type="submit" value="Nakijken">
                
            </form>
            <script>
                let score = 0;
                document.getElementById("score").innerHTML = score;


                $('#wordCheck0').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Hello") {
                        $( "#wordCheck0" ).addClass( "right-ans" );
                        score += 1;
                        document.getElementById("score").innerHTML = score;
                    } 
                });
                $('#wordCheck1').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Bye") {
                        $( "#wordCheck1" ).addClass( "right-ans" );
                        score += 1;
                        document.getElementById("score").innerHTML = score;
                    }
                });
                $('#wordCheck2').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Me") {
                        $( "#wordCheck2" ).addClass( "right-ans" );
                        score += 1;
                        document.getElementById("score").innerHTML = score;
                    }
                });
                $('#wordCheck3').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "You") {
                        $( "#wordCheck3" ).addClass( "right-ans" );
                        score += 1;
                        document.getElementById("score").innerHTML = score;
                    }
                });
                $('#wordCheck4').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "City") {
                        $( "#wordCheck4" ).addClass( "right-ans" );
                        score += 1;
                        document.getElementById("score").innerHTML = score;
                    }
                });
                $('#wordCheck5').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Village") {
                        $( "#wordCheck5" ).addClass( "right-ans" );
                        score += 1;
                        document.getElementById("score").innerHTML = score;
                    }
                });
                $('#wordCheck6').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Apple") {
                        $( "#wordCheck6" ).addClass( "right-ans" );
                        score += 1;
                        document.getElementById("score").innerHTML = score;
                    }
                });
                $('#wordCheck7').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Banana") {
                        $( "#wordCheck7" ).addClass( "right-ans" );
                        score += 1;
                        document.getElementById("score").innerHTML = score;
                    }
                });
                $('#wordCheck8').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "House") {
                        $( "#wordCheck8" ).addClass( "right-ans" );
                        score += 1;
                        document.getElementById("score").innerHTML = score;
                    }
                });
                $('#wordCheck9').keyup(function() {
                    var newInput = this.value;
                    if (newInput == "Room") {
                        $( "#wordCheck9" ).addClass( "right-ans" );
                        score += 1;
                        document.getElementById("score").innerHTML = score;
                    }
                });
            </script>

        </div>
    </div>
</body>
</html>
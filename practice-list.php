<?php 
session_start();    

include 'Auth/config.php';

// include 'get-data.php';

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
        <div style="margin-right: 2rem; text-align: right;">
            <div class="word-list">
                <?php 
                    while ($row = mysqli_fetch_array($result)) {
                        // $results[50] = $row["word_en"];
                        // foreach ($results as $key => $value) {
                        //     echo "<p id='word_en[]'>".$value."</p>";              
                        // }                       
                    ?>
                
                    <tr>
                        <div id="divWordNL">
                            <p class="line-height"><?php echo $row["word_nl"]; ?></p>
                        </div>
                    </tr>
                <?php 
                    }
                ?>            
            </div>                
        </div>       
        
        <div style="margin-left: 2rem;">
            <form id="input-form" class="input-form" method="post">
                <?php 
                    for ($i=0;$i<50;$i++) {
                        while ($row = mysqli_fetch_array($result2)) {   
                ?>
                    <input id="wordID<?php echo $i?>" type="hidden" value="<?php echo $row["id"]; ?>">
                    <input style="height: 22px;" type="text" id="wordCheck<?php echo $i++;?>" name="word-en[]" onkeydown="showCustomer(this.value)" required>
                    <!-- <div id="txtHint"></div>        -->
                <?php 
                        }
                    }
                ?>  

                <!-- <input onclick="AnsCheck()" type="button" value="Nakijken"> -->
            </form>
            <script>
                // function showCustomer(str) {
                //     if (str == "") {
                //         document.getElementById("txtHint").innerHTML = "";
                //         return;
                //     }
                //     const xhttp = new XMLHttpRequest();
                //     xhttp.onload = function() {
                //         document.getElementById("txtHint").innerHTML = this.responseText;
                //     }
                //     xhttp.open("GET", "get-data.php?q="+str);    
                //     xhttp.send();
                // }


                let div1 = document.getElementById("divWordNL");
                let allParas = div1.getElementsByTagName('p');
                let num = allParas.length;

                console.log(num);


                
                let id = document.getElementById("wordID5");
                console.log(id);            

                fetch ("get-data.php", {
                    method: 'POST',
                    // data die je meegeeft:
                    body: JSON.stringify({words: 10, fortnite: "is leuk"}),

                })
                .then((result) => {
                    
                    if (result.status != 200) { throw new Error("Bad Server Response");}
                    return result.text();
                })
                .then((response) => {
                    // data is de data die je terug krijgt
                    let data = JSON.parse(response);
                    console.log(data)
                })

                // $('#wordCheck0').keyup(function() {
                //     var newInput = this.value;
                //     if (newInput == "Hello") {
                //         if ($("#wordCheck0").hasClass("right-ans")) {
                //             score = score;
                //         } else {
                //             $("#wordCheck0").addClass("right-ans");
                //             score += 1;
                //         }
                //     } 
                // });
                // $('#wordCheck1').keyup(function() {
                //     var newInput = this.value;
                //     if (newInput == "Bye") {
                //         if ($("#wordCheck1").hasClass("right-ans")) {
                //             score = score;
                //         } else {
                //             $("#wordCheck1").addClass("right-ans");
                //             score += 1;
                //         }
                //     }
                // });
                // $('#wordCheck2').keyup(function() {
                //     var newInput = this.value;
                //     if (newInput == "Me") {
                //         if ($("#wordCheck2").hasClass("right-ans")) {
                //             score = score;
                //         } else {
                //             $("#wordCheck2").addClass("right-ans");
                //             score += 1;
                //         }
                //     }
                // });
                // $('#wordCheck3').keyup(function() {
                //     var newInput = this.value;
                //     if (newInput == "You") {
                //         if ($("#wordCheck3").hasClass("right-ans")) {
                //             score = score;
                //         } else {
                //             $("#wordCheck3").addClass("right-ans");
                //             score += 1;
                //         }
                //     }
                // });
                // $('#wordCheck4').keyup(function() {
                //     var newInput = this.value;
                //     if (newInput == "City") {
                //         if ($("#wordCheck4").hasClass("right-ans")) {
                //             score = score;
                //         } else {
                //             $("#wordCheck4").addClass("right-ans");
                //             score += 1;
                //         }
                //     }
                // });
                // $('#wordCheck5').keyup(function() {
                //     var newInput = this.value;
                //     if (newInput == "Village") {
                //         if ($("#wordCheck5").hasClass("right-ans")) {
                //             score = score;
                //         } else {
                //             $("#wordCheck5").addClass("right-ans");
                //             score += 1;
                //         }
                //     }
                // });
                // $('#wordCheck6').keyup(function() {
                //     var newInput = this.value;
                //     if (newInput == "Apple") {
                //         if ($("#wordCheck6").hasClass("right-ans")) {
                //             score = score;
                //         } else {
                //             $("#wordCheck6").addClass("right-ans");
                //             score += 1;
                //         }
                //     }
                // });
                // $('#wordCheck7').keyup(function() {
                //     var newInput = this.value;
                //     if (newInput == "Banana") {
                //         if ($("#wordCheck7").hasClass("right-ans")) {
                //             score = score;
                //         } else {
                //             $("#wordCheck7").addClass("right-ans");
                //             score += 1;
                //         }
                //     }
                // });
                // $('#wordCheck8').keyup(function() {
                //     var newInput = this.value;
                //     if (newInput == "House") {
                //         if ($("#wordCheck8").hasClass("right-ans")) {
                //             score = score;
                //         } else {
                //             $("#wordCheck8").addClass("right-ans");
                //             score += 1;
                //         }
                //     }
                // });
                // $('#wordCheck9').keyup(function() {
                //     var newInput = this.value;
                //     if (newInput == "Room") {
                //         if ($("#wordCheck9").hasClass("right-ans")) {
                //             score = score;
                //         } else {
                //             $("#wordCheck9").addClass("right-ans");
                //             score += 1;
                //         }
                //     }
                // });
                
            </script>
        </div>       
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

                <input onclick="AnsCheck()" type="button" value="Nakijken">
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
<?php

include 'Auth/config.php';

GLOBAL $conn;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();    

$listid = $_POST["listid"];
$listname = $_POST["listname"];

if(array_key_exists('addWords', $_POST)) {
    addWords();
}

if(array_key_exists('deleteWord', $_POST)) {
    deleteWord();
}

$getWords = "SELECT * FROM word WHERE list_id=$listid";
$result = mysqli_query($conn, $getWords);   

function addWords() {
    include 'Auth/config.php';

    $listid = $_POST["listid"];
    $wordsNL = $_POST["word-nl"];
    $wordsEN = $_POST["word-en"];

    GLOBAL $conn;

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    foreach (array_combine($wordsNL, $wordsEN) as $wordNL => $wordEN) {
        if (!empty($wordNL) && !empty($wordEN)) {            
            $sql = "INSERT INTO word (list_id, word_nl, word_en) VALUES ('$listid', '$wordNL', '$wordEN')";
        } else {
            continue;
        }
        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Versturen van de data is mislukt!";
        }
    }

};

function deleteWord() {
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

<html>
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script type="text/javascript">
        function addTextArea(){
            var div2 = document.getElementById('word-nl');
            div2.innerHTML += "<input type='hidden' name='listid' value='<?php echo $listid ?>'/>";
            div2.innerHTML += "<input class='marg-top-10 input-txt-ctr' type='text' name='word-nl[]' />";
            div2.innerHTML += "\n<br />";

            var div3 = document.getElementById('word-en');
            div3.innerHTML += "<input class='marg-top-10 input-txt-ctr' type='text' name='word-en[]' />";
            div3.innerHTML += "\n<br />";

            var div4 = document.getElementById('verwijderen');
            div4.innerHTML += "<input class='marg-top-10 button-reset button-delete' name='delAddedWord' type='reset' value='verwijder' />";
            div4.innerHTML += "\n<br />";
        }

    </script>
    <style>
        body {
            font: 16px sans-serif; 
        }

        .line-height {
            line-height: 20px;
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

        .marg-top-10 {
            margin-top: 10px;
        }

        .input-txt-ctr {
            text-align: center;
        }

        .lijst-div {
            flex-direction: column;
        }
        #main {
            width: 50px;
            height: 50px;
        }
        
        #main .AppGNB_6Button {
            cursor: pointer;
        }
        
        #main .AppGNB_6Button .AppGNB {
            position: absolute;
            overflow: hidden;            
            width: 50px;
            height: 50px;
            border-radius: 100%;
        }
        
       
        #main .AppGNB_6Button .AppGNB .bgGreen {
            position: absolute;
            width: 50px;
            height: 50px;
            background-color: #007bff;
        }
        #main .AppGNB_6Button .AppGNB.on .bgGreen {
            opacity: 0; 
        }

        #main .AppGNB_6Button .AppGNB .plusIcon {
            position: absolute;
            height: 30px;
            width: 30px;
            top: 0px;
            left: 0px;
            z-index: 100;
        }
            
        #main .AppGNB_6Button .AppGNB .plusIcon div:nth-child(1) {
            position: absolute;
            background: #ffffff;
            height: 30px;
            width: 3px;
            top: 10px;
            left: 23px;
        }
        #main .AppGNB_6Button .AppGNB .plusIcon div:nth-child(2) {
            position: absolute;
            background: #ffffff;
            height: 3px;
            width: 30px;
            top: 23px;
            left: 10px;
        }

        svg {
            width: 50px;
        }

        .form-center {
            width: 430px;
            display: flex;
            justify-content: center;

        }

    </style>
</head>
<body>
<h6><a href="welcome.php">terug</a></h6>
    <div style="margin: 3rem;">
        <h4 style ="padding-left: 4rem; padding-bottom: 1rem;"><?php echo $listname ?></h4>
            <?php     
                while ($row = mysqli_fetch_array($result)) {    
            ?>
            <form method="post" id="default-form">
                <div style="display: flex; flex-direction: row;">
                    <div class="form-center">
                        <input type="hidden" name="listname" value="<?php echo $listname?>" />
                        <div style="display: flex; justify-content: space-evenly;" class="marg-top-10">
                            <div>
                                <div>
                                    <input type="hidden" name="listid" value='<?php echo $listid; ?>'>
                                    <input class="input-txt-ctr" type="text" name="word-nl[]" id="<?php echo $row["id"]; ?>" value="<?php echo $row["word_nl"]; ?>"/>
                                </div>
                            </div>
                            <div style="padding-left: 30px;">
                                <div>
                                    <input class="input-txt-ctr" type="text" name="word-en[]" value="<?php echo $row["word_en"]; ?>"/> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: 10px;">
                        <div>
                            <input type="hidden" name="wordId" value='<?php echo $row["id"]; ?>'>
                            <input class="button-reset button-delete" name="deleteWord" type="submit" value="verwijder">
                        </div>
                    </div>
                </div>
            </form>
            <?php 
                }
            ?>
            
            <form id="saveWordForm" method="post">
                <div style="display: flex; flex-direction: row;">
                    <div class="form-center">
                        <div style="display: flex; flex-direction: row;" class="marg-top-10">
                            <div>
                                <div>
                                    <input type="hidden" name="listid" value='<?php echo $listid; ?>'>
                                    <input type="hidden" name="listname" value='<?php echo $listname; ?>'>
                                    <input class="input-txt-ctr" type="text" name="word-nl[]"/>
                                    <div id="word-nl"></div>
                                </div>
                            </div>
                            <div style="margin-left: 30px;">
                                <div>
                                    <input class="input-txt-ctr" type="text" name="word-en[]"/>
                                    <div id="word-en"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: 10px;">
                        <div>
                            <input type="hidden" name="wordIdd" value='<?php echo $row["id"]; ?>'>
                            <input class="button-reset button-delete" id="delete_button<?php echo $row['id'];?>" name="delAddedWord" type="submit" value="verwijder">
                            <div id="verwijderen"></div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
            <script> 
                //gaat in input veld
                
                // onclick="delete_row('
                <?php 
                // echo $row['id'];
                ?>
                // ');" 


                // function delete_row(id)
                // {
                //     $.ajax ({
                //         type:'POST',
                //         url:'delete-data.php',
                //         data:{
                //         delete_row:'delete_row',
                //         row_id:id,
                //         },
                //         success:function(response) {
                //             if(response=="success")
                //             {
                //                 var row=document.getElementById("row"+id);
                //                 row.parentNode.removeChild(row);
                //             }
                //         }
                //     });
                // }
                            </script>
        </div>
        <div style="width: 430px; margin-left: 3rem;" class="lijst-div" style="margin-top:30px;">
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 369.946 369.946" onClick="addTextArea();" style="enable-background:new 0 0 369.946 369.946;" xml:space="preserve">
                    <g>
                        <path style="fill:#007bff;" d="M184.973,0C82.975,0,0,82.975,0,184.973s82.975,184.973,184.973,184.973
                            s184.973-82.975,184.973-184.973S286.971,0,184.973,0z M256.575,190.94H190.94v65.636h-11.934V190.94h-65.636v-11.934h65.636
                            v-65.636h11.934v65.636h65.636V190.94z"/>
                    </g>
                </svg>
            <div class="lijst-div" style="margin-top: 20px;">
                <input form="saveWordForm" style="width: 175px;" id="showData" class="btn btn-warning" type="submit" name="addWords" value="Woorden opslaan!">
            </div>
            <script>
          
            </script>
        </div>
    </div>
</body>
</html>
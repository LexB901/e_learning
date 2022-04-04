<?php

session_start();   

include 'Auth/config.php';
include 'function.php';

checkLogin();

GLOBAL $conn;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$listid = $_GET["listid"];
$listname = $_GET["listname"];

if(array_key_exists('addWords', $_POST)) {
    addWords();
}

$getWords = "SELECT * FROM word WHERE list_id=$listid";
$result = mysqli_query($conn, $getWords);  
$result2 = mysqli_query($conn, $getWords);  

?>

<html>
<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
<h6><a class="btn btn-warning m-3" href="welcome.php">terug</a></h6>
    <div style="margin: 3rem;">
        <h4 style ="padding-bottom: 1rem; text-align: center;"><?php echo $listname ?></h4>
        <div style="display: flex; justify-content: center;">
            <div style="width: 460px; display: flex; justify-content: flex-end; margin-bottom: 1rem;">
                <img id="List" class="display-block" onclick="HideList()" width="20px" height="20px" src="img/delete.png" alt="delete words">
                <a href="javascript:location.reload();">
                    <img id="hideList" class="display-none" onclick="ShowList()" width="20px" height="20px" src="img/delete.png" alt="delete words">
                </a>

            </div>
        </div>
        <div id="wordList">
            <div class="form-center">
                <div style="width: 460px; display: flex;" class="marg-top-10">
                    <div>
                        <p style="width: 215px; text-align: center;" class="input-txt-ctr">
                            Nederlandse woorden:
                        </p>
                    </div>
                    <div>
                    <p style="width: 215px; margin-left: 30px; text-align: center;" class="input-txt-ctr">
                            Engelse woorden:
                        </p>
                    </div>
                </div>
            </div>
            <form id="saveWordForm" method="post">
                <?php     
                    while ($row = mysqli_fetch_array($result)) {    
                ?>
                    <div id="deleteWordForm2<?php echo $row['id']; ?>">
                        <div class="form-center">
                            <input type="hidden" name="listname" value="<?php echo $listname?>" />
                            <div style="display: flex; justify-content: space-evenly;" class="marg-top-10">
                                <div>
                                    <div>
                                        <input type="hidden" name="listid" value='<?php echo $listid; ?>'>
                                        <input class="input-txt-ctr wordListStyle" type="text" name="word-nl[]" id="<?php echo $row["id"]; ?>" value="<?php echo $row["word_nl"]; ?>"/>
                                    </div>
                                </div>
                                <div style="padding-left: 30px;">
                                    <div>
                                        <input class="input-txt-ctr wordListStyle" type="text" name="word-en[]" value="<?php echo $row["word_en"]; ?>"/> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php 
                    }
                ?>
                
                <div class="form-center">
                    <div style="display: flex;" class="marg-top-10">
                        <div>
                            <div>
                                <input type="hidden" name="listid" value='<?php echo $listid; ?>'>
                                <input type="hidden" name="listname" value='<?php echo $listname; ?>'>
                                <input autofocus class="input-txt-ctr wordListStyle" type="text" name="word-nl[]"/>
                            </div>
                        </div>
                        <div style="margin-left: 30px;">
                            <div>
                                <input class="input-txt-ctr wordListStyle" type="text" name="word-en[]"/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div style="margin-top: 0px;" class="lijst-div" style="margin-top:30px;">
                <div style="width: 430px;" style="margin-top:30px;">
                    <div class="lijst-div" style="margin-top: 20px;">
                        <input form="saveWordForm" style="width: 175px;" class="btn btn-warning" type="submit" name="addWords" value="Woorden opslaan!">
                    </div>
                </div>
            </div>
        </div>
        <div id="deleteList" class="display-none">
            <?php     
                while ($row = mysqli_fetch_array($result2)) {    
            ?>
                <form id="deleteWordForm<?php echo $row['id'];?>" method="post">
                    <div style="display: flex; flex-direction: row; justify-content: center;">
                        <div class="form-center">
                            <input type="hidden" name="listname" value="<?php echo $listname?>" />
                            <div style="display: flex; justify-content: space-evenly;" class="marg-top-10">
                                <div>
                                    <div>
                                        <input type="hidden" name="listid" value='<?php echo $listid; ?>'>
                                        <p class="input-txt-ctr wordListStyle" name="word-nl[]"><?php echo $row["word_nl"]; ?></p>
                                    </div>
                                </div>
                                <div style="padding-left: 30px;">
                                    <div>
                                        <p class="input-txt-ctr wordListStyle" name="word-en[]"><?php echo $row["word_en"]; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 10px;">
                            <div style="margin-left: 5px;">
                                <input id="wordID" type="hidden" name="listid" value='<?php echo $listid; ?>'>
                                <input class="btn btn-danger" onclick="delete_data(<?php echo $row['id']; ?>)" type="button" value="verwijder">
                            </div>
                        </div>
                    </div>
                </form>
            <?php 
                }
            ?>
            <script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
                
            </script>
        </div>
    </div>
</body>
</html>
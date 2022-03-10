<?php

include 'Auth/config.php';

GLOBAL $conn;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the session
session_start();
 

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: Auth/login.php");
    exit;
}

if(array_key_exists('new-list', $_POST)) {
    newList();
}

if(array_key_exists('deleteList', $_POST)) {
    deleteList();
}

$userid =($_SESSION["id"]);




function newList() {
    include 'Auth/config.php';

    $userid =($_SESSION["id"]);
    $listname = $_POST["list-name"];
     
    GLOBAL $conn;

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO list (list_name, user_id) VALUES ('$listname', '$userid')";
    
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
    
    $sql = "DELETE FROM list WHERE id=$listid";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
};
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">

    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            font: 14px sans-serif; 
            text-align: center;
        }
        .my-5 {
            margin-top: 1rem!important;
        }
        .house-color {
            color: #ffc107;
        }
        .house-color:hover {
            color: #ffc107;
        }
        table {  
            border-collapse: collapse;  
        }  
        .inline{   
            display: inline-block;   
            float: right;   
            margin: 20px 0px;   
        }            
        input, button{   
            height: 34px;   
        }    
        .items {   
            display: inline-block;   
        }   
        .items a {   
            font-weight:bold;   
            font-size:18px;   
            color: black;   
            float: left;   
            padding: 8px 16px;   
            text-decoration: none;   
            border:1px solid black;  
            margin: 2px; 
        }   
        .items a.active {   
            
            background-color: rgba(175, 201, 244, 0.97);   
        }   
        .items a:hover:not(.active) {   
            background-color: #87ceeb;   
        }

        .button-reset {
            border: none;
            background-color: transparent;
            height: auto;
        }

        .button-delete {
            color: red;
        }

        .button-edit {
            color: blue;
        }

        .button-delete:hover {
            text-decoration: underline;
        }
        
        .button-edit:hover {
            text-decoration: underline;
        }

        .bg-white {
            background-color: white;
        }
        
    </style>
</head>
    
    
    
    

<body>   
    <div class="welcome-header-message">
        <div class="login-message">
            <h1 class="my-5">Hallo, <b><?php 
            echo htmlspecialchars($_SESSION["username"]); 
            ?></b>. Je bent succesvol ingelogd!</h1>
        </div>
        <div class="button-group">
            <a href="Auth/reset-password.php" class="btn btn-warning my-5">Wijzig je wachtwoord</a>
            <a href="Auth/logout.php" class="btn btn-danger my-5">Uitloggen</a>
        </div>
    </div>
    <div style="margin-top: 100px;">
        <form method="post">
            <p>Maak een lijst aan!</p>
            <input type="text" name="list-name" placeholder="Naam van de lijst." autofocus>
            <input type="submit" name="new-list" value="Nieuwe lijst"/>
        </form>
    </div>
    
    <?php    
        include 'Auth/config.php';
  
        $limit = 15;    

        if (isset($_GET["page"])) {    
            $page_number  = $_GET["page"];    
        } else {    
            $page_number=1;    
        }       

        $initial_page = ($page_number-1) * $limit;       
        $getQuery = "SELECT * FROM list WHERE user_id=$userid LIMIT $initial_page, $limit";     
        $result = mysqli_query ($conn, $getQuery);    
    ?>
    <div class="container" style="margin-top: 40px;">   
        <br>   
        <div>   
            <table class="table table-striped table-condensed table-bordered">   
                <thead>   
                <tr>   
                    <th width="70%">Name</th>
                    <th width="10%">Oefenen</th>   
                    <th width="10%">Bewerken</th>   
                    <th width="10%">Verwijderen</th>   
                </tr>   
                </thead>   
                <tbody>   
                <tr>
                    <td class="bg-white">Standaard lijst</td>
                    <td class="bg-white"><a class="house-color" href="default-list.php">Oefenen</a></td>
                    <td class="bg-white">   </td>
                    <td class="bg-white"></td>
                </tr>
                <?php     
                    while ($row = mysqli_fetch_array($result)) {    
                ?>     
                
                <tr>     
                    <td class="bg-white"><?php echo $row["list_name"]; ?></td>   
                    <td class="bg-white"></td>
                    <td class="bg-white">
                        <form method="post" action="edit-list.php">
                            <input type="hidden" name="listid" value='<?php 
                            echo $row["id"]; 
                            ?>'>
                            <input type="hidden" name="listname" value='<?php
                             echo $row["list_name"]; 
                             ?>'>
                            <input type="submit" name="editList" value="bewerken" class="button-edit button-reset">
                        </form></td>
                    <td class="bg-white">
                        <form method="post">
                            <input type="hidden" name="rowid" value='<?php 
                            echo $row["id"]; 
                            ?>'>
                            <input class="button-reset button-delete" name="deleteList" type="submit" value="verwijder">
                        </form>
                    </td>
                </tr>     

                <?php     
                    };    
                ?>     

                </tbody>   
            </table>    
            <div class="Items">    

            <?php  
                $getQuery = "SELECT COUNT(*) FROM list WHERE user_id=$userid";     
                $result = mysqli_query($conn, $getQuery);     
                $row = mysqli_fetch_row($result);     
                $total_rows = $row[0];              
                echo "</br>";            
                $total_pages = ceil($total_rows / $limit);     
                $pageURL = "";             

                if($page_number>=2){   
                    echo "<a class='house-color' href='welcome.php?page=".($page_number-1)."'>  Prev </a>";   
                }                          
                for ($i=1; $i<=$total_pages; $i++) {   
                    if ($i == $page_number) {   
                        $pageURL .= "<a class = 'house-color active' href='welcome.php?page=".$i."'>".$i." </a>";   
                    } else {   
                        $pageURL .= "<a class = 'house-color' href='welcome.php?page=".$i."'>".$i." </a>";     
                    }   
                };     

                echo $pageURL;    

                if($page_number<$total_pages) {   
                    echo "<a class= 'house-color' href='welcome.php?page=".($page_number+1)."'>  Next </a>";
                }     
                ?>    

            </div>       
        </div>   
    </div>  
</body>  
</html>




<?php 

// $name = "Lex";
// $city = "Hilversum";
// $age = 20;
// $startdate = '2020-08-30';

// $skills = implode(" | ", [
//     'JavaScript',
//     'PHP',
//     'MySQL',
//     'Laravel'
// ]);
// echo "Hi my name is {$name}. I'm {$age} years old and live in {$city}<br><br>";
// echo "Programming since: {$startdate}<br>";
// echo "Skills: {$skills}"

?>
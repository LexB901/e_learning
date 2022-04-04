<?php

session_start();

include 'Auth/config.php';
include 'function.php';

checkLogin();

GLOBAL $conn;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function check_login($con)
{

  if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE user_id = '$id' LIMIT 1";

    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
      $user_data = mysqli_fetch_assoc($result);
      return $user_data;
    }
  }
  //redirect to login
  header("Location: login.php");
  die;
}



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
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <title>Welcome</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
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
            text-decoration: underline;
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
            background-color: #ffc107;
        }
        .items a.active:hover {   
            background-color: #ffc107;
        }   
        .items a:hover:not(.active) {  
            background-color: #ffc107;
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

        .txt-align-center {
            text-align: center;
        }
        
        .new-list {
            height: 38px;
            text-align: center;
        }

        .absolute-right {
            position: absolute;
            right: 0;
        }

        .line-height-1 {
            line-height: 1 !IMPORTANT;
        }

        .border-none {
            border: none;
        }
        .table thead th {
            border: none;
            vertical-align: middle;
        }

        .table td {
            border: none;
            vertical-align: middle;
            padding: 4px;
        }

        .table {
            width: auto;
        }

        .list-names-table {
            margin-bottom: 100px; 
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .marg-right-6rem {
            margin-right: 6rem;
        }
        
    </style>
</head>

<body>
    <div class="welcome-header-message">
        <div class="login-message">
            <h1 class="my-5">Hallo <b><?php 
            echo htmlspecialchars($_SESSION["username"]); 
            ?></b>, Je bent succesvol ingelogd!</h1>
        </div>
        <div class="button-group">
            <a href="Auth/reset-password.php" class="btn btn-warning my-5">Wijzig je wachtwoord</a>
            <a href="Auth/logout.php" class="btn btn-danger my-5">Uitloggen</a>
        </div>
    </div>
    <div style="margin-top: 100px;">
        <form method="post">
            <h4>Maak een lijst aan!</h4>
            <input maxlength="25" class="new-list" type="text" name="list-name" placeholder="Naam van de lijst." autofocus>
            <input style="height: 38px;" class="btn btn-primary" type="submit" name="new-list" value="Nieuwe lijst"/>
        </form>
    </div>
    
    <?php    
        include 'Auth/config.php';
  
        $limit = 5;    

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
        <div class="list-names-table">   
            <table class="table table-striped table-condensed">      
                <tbody>   
                    <tr>
                        <td class="bg-white">
                            <div class="marg-right-6rem">
                                Standaard lijst
                            </div>
                        </td>
                        <td class="bg-white">
                            <form action="default-list.php">
                                <input type="submit" class="btn btn-warning line-height-1" href="default-list.php" value="Oefenen"/>
                            </form>
                        </td>
                        <td class="bg-white"></td>
                        <td class="bg-white"></td>
                    </tr>
                    <?php     
                        while ($row = mysqli_fetch_array($result)) {    
                    ?>     
                    
                    <tr>     
                        <td class="bg-white">
                            <div class="marg-right-6rem">
                                <?php echo $row["name"]; ?>
                            </div>
                        </td>   
                        <td class="bg-white">
                            <form method="get" action="practice.php">
                                <input type="hidden" name="id" value='<?php
                                echo $row["id"];
                                ?>'>
                                <input type="hidden" name="listname" value='<?php
                                echo $row["name"]; 
                                ?>'>   
                                
                                <input type="submit" value="Oefenen" class="btn btn-warning line-height-1">
                                
                            </form>
                        </td>
                        <td class="bg-white">
                            <form method="get" action="edit-list.php">
                                <input type="hidden" name="listid" value='<?php 
                                echo $row["id"]; 
                                ?>'>
                                <input type="hidden" name="listname" value='<?php
                                echo $row["name"]; 
                                ?>'>
                                <input type="submit" name="editList" value="Bewerken" class="btn btn-primary line-height-1">
                            </form>
                        </td>
                        <td class="bg-white">
                            <form method="post">
                                <input type="hidden" name="rowid" value='<?php 
                                echo $row["id"]; 
                                ?>'>
                                <input class="btn btn-danger line-height-1" name="deleteList" type="submit" value="verwijder">
                            </form>
                        </td>
                    </tr>     

                    <?php     
                        };    
                    ?>     

                </tbody>   
            </table>    
            <div class="items">    

            <?php  
                $getQuery = "SELECT COUNT(*) FROM list WHERE user_id=$userid";     
                $result = mysqli_query($conn, $getQuery);     
                $row = mysqli_fetch_row($result);     
                $total_rows = $row[0];              
                echo "</br>";            
                $total_pages = ceil($total_rows / $limit);     
                $pageURL = "";             

                if($page_number>=2){   
                    echo "<a class='btn color-black' href='welcome.php?page=".($page_number-1)."'>  Prev </a>";   
                }                          
                for ($i=1; $i<=$total_pages; $i++) {   
                    if ($i == $page_number) {   
                        $pageURL .= "<a class = 'btn color-black active' href='welcome.php?page=".$i."'>".$i." </a>";   
                    } else {   
                        $pageURL .= "<a class = 'btn color-black' href='welcome.php?page=".$i."'>".$i." </a>";     
                    }   
                };     

                echo $pageURL;    

                if($page_number<$total_pages) {   
                    echo "<a class= 'btn color-black' href='welcome.php?page=".($page_number+1)."'>  Next </a>";
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
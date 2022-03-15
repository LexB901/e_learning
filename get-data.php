<?php
include 'Auth/config.php';

GLOBAL $conn;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

GLOBAL $listid;

session_start();

$sql = "SELECT * FROM word WHERE list_id = $listid";

// $stmt = $conn->prepare($sql);
// $stmt->bind_param("s", $_GET['q']);
// $stmt->execute();
// $stmt->store_result();
// $userInput = $_GET['q'];
// $stmt->bind_result($id, $word_nl, $word_en);
// if($userInput == $word_en) {
//     echo "goed!";
// } else {
//     echo "fout!";
// }
// $stmt->fetch();
// $stmt->close();


header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

header("Access-Control-Allow-Methods: GET");

header("Allow: POST");

header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");

// hier je code

// $input is de data die je hebt mee gegeven
$input = json_decode(file_get_contents('php://input'), true);
$kills = $input["kills"];

// print de data die je terug wilt geven aan de ajax call

print json_encode([
    "data1" => "Ik hou van fortnite",
    "kills " => $kills,
]);
?>
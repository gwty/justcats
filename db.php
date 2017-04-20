<?php
session_start();
require_once('php/credentials.php');

$username2 = $_POST["Username"];
<<<<<<< HEAD
if($_POST["Name"])
$name = $_POST["Name"];
else
$name = "not set";
if($_POST["Email"])
$email = $_POST["Email"];
else
$email = "not set";
if($_POST["Company"])
$company = $_POST["Company"];
else
$company = "not set";
if($_POST["Title"])
$position = $_POST["Title"];
else
$position = "not set";
if($_POST["Summary"])
$summary = $_POST["Summary"];
else
$summary= "not set";
=======
$name = $_POST["Name"];
$email = $_POST["Email"];
$company = $_POST["Company"];
$position = $_POST["Title"];
$summary = $_POST["Summary"];
>>>>>>> 03f0905f8bce38b69adae491af2a0dcd2ce6bf6c
// Create connection
$conn = new mysqli($servername, $dbusername, $password, $dbname);

session_start();

 registeruser($username2,$name,$email,$company,$position,$summary, $conn);
print_r($_SESSION);
function registeruser($username2, $name="", $email= " ", $company=" ", $position=" ", $summary=" ", $conn) {

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if(!$summary)
  $summary = "not set";
if(!$name)
  $name = "not set";  
if(!$email)
  $email = "not set";    
if(!$company)
  $company = "not set";
if(!$position)
  $position = "not set";    
  
$getsql = "SELECT id,username,name from users where username = '".$username2."'";  
$result = $conn->query($getsql);

if($result->num_rows>0) {
$row = $result->fetch_assoc();
setcookie("id", "", time() - 3600);
setcookie("username", "", time() - 3600);
session_unset(); 
    $_SESSION["id"]=$row['id'];
    $_SESSION["username"]=$row["username"];

header( 'Location: game.html');
//   return $row["id"];
}
else {
$sql = "INSERT INTO users (username, name,email,company,position,summary)
VALUES ('".$username2."','".$name."','".$email."','".$company."','".$position."','".$summary."')";
$result = $conn->query($sql);
$result = $conn->query($getsql);
  if($result->num_rows>0) {
    $row = $result->fetch_assoc();
    session_unset(); 
    $_SESSION["id"]=$row['id'];
    $_SESSION["username"]=$row["username"];
header( 'Location: game.html');
return $row["id"];
  }
}
$conn->close();
}

?>
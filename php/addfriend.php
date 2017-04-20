    <script src= "../js/gameelements.js"></script>
    <link href="../css/game.css" rel="stylesheet" />
    
    <?php 
session_start();
print_r($_SESSION);
require_once('credentials.php');
// Create connection
$conn = new mysqli($servername, $dbusername, $password, $dbname);

if(isset($_POST['addfriend']) && isset($_SESSION["id"]) )
{
$conn = new mysqli($servername, $dbusername, $password, $dbname);

$sql = "INSERT INTO messages (fromuser, touser,type)
VALUES (".$_SESSION["id"].",".$_POST['addfriend'].",0)";
$result = $conn->query($sql);



$conn->close();
// echo $sql;
//header( 'Location: ../game.html');
?>
<script>closepage("messages");</script>
<?php
}

if(isset($_POST['message']) && isset($_SESSION['id'])) {
$conn = new mysqli($servernasme, $username2, $password, $dbname);
$sql = "INSERT INTO messages(fromuser, touser , message, type)
VALUES ('".$_SESSION['id']."','".$_POST['message']."','".$_POST['messagecontent'].",1')";
$result = $conn->query($sql);
$conn->close();
header( 'Location: ../game.html');
}

if(isset($_POST['requestmeeting']) && isset($_SESSION['id']) ){
$conn = new mysqli($servername, $username2, $password, $dbname);
$sql = "INSERT INTO messages(fromuser, touser , message, type)
VALUES ('".$_SESSION['id']."','".$_POST['requestmeeting']."','".$_POST['messagecontent'].",2')";
$result = $conn->query($sql);
$conn->close();
header( 'Location: ../game.html');
}
?>

<?php 
session_start();
require_once('credentials.php');
$conn = new mysqli($servername, $dbusername, $password, $dbname);
getfriends($conn);

function getfriends ($conn) {
// Create connection
if(isset($_POST['acceptfr']) && isset($_SESSION['id']) )
{

$sql = "INSERT INTO friends (userA, userB)
VALUES (".$_SESSION['id'].",".$_POST['acceptfr'].")";
$result = $conn->query($sql);

$sql = "INSERT INTO friends (userB, userA)
VALUES (".$_SESSION['id'].",".$_POST['acceptfr'].")";
$result = $conn->query($sql);

$sql = "DELETE FROM messages 
where touser = ".$_SESSION['id']." and fromuser=".$_POST['acceptfr'];
$result = $conn->query($sql);

$conn->close();
header( 'Location: ../game.html');
}

if(isset($_POST['deniedfr']) && isset($_SESSION['id']) )
{
$conn = new mysqli($servername, $username2, $password, $dbname);

$sql = "INSERT INTO deniedfriends (userA, userB)
VALUES (".$_SESSION['id'].",".$_POST['deniedfr'].")";
$result = $conn->query($sql);
$conn->close();
header( 'Location: ../game.html');

$sql = "DELETE FROM messages (fromuser, touser)
VALUES (".$_SESSION['id'].",".$_POST['acceptfr'].")";
$result = $conn->query($sql);
$conn->close();
header( 'Location: ../game.html');
}

$conn->close();
}
?>
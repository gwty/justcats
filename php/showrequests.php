<?php 
session_start();
require_once('credentials.php');
// Create connection
$conn = new mysqli($servername, $dbusername, $password, $dbname);

showrequests($conn);
function showrequests ($conn) {

$fromuser = "SELECT fromuser from messages where type=0 and touser=".$_SESSION['id']; 
$result = $conn->query($fromuser);
$friends = "SELECT touser from users where type=0 and fromuser=".$_SESSION['id']; 
$friendsresult = $conn->query($fromuser);
$result = $conn->query($fromuser);
$result2 = $conn->query($friends);
if($result->num_rows>0) {
while($row = $result->fetch_assoc()) {
        $getsql = "SELECT id, username from users where id=".$row['fromuser'];  
        $result3 = $conn->query($getsql);
        $row2 = $result3->fetch_assoc();
        echo "<b>".$row2['username']."</b> wants to be friends with you."."<form action='php/friendrequests.php' method='post'><button name='acceptfr' value=".$row2['id'].">Accept</button><button name='declinefr' value=".$row2['id'].">Decline</button></form>";
    }
}

if($result2->num_rows>0) {
while($row = $result2->fetch_assoc()) {
        $getsql = "SELECT id, username from users where id=".$row['touser'];  
        $result3 = $conn->query($getsql);
        $row2 = $result3->fetch_assoc();
        echo "<b>".$row2['username']."</b> accepted your friend request. <br><hr>";

    }
}

$conn->close();
}
// ?>
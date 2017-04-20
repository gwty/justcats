      <?php 
require_once('credentials.php'); 
showrequests();

function showrequests () {
$conn = new mysqli($servername, $dbusername, $password, $dbname);
$fromuser = "SELECT fromuser from messages where type=0 and touser=".$_COOKIE["id"]; 
$result = $conn->query($fromuser);

$friends = "SELECT touser from messages where type=0 and fromuser=".$_COOKIE["id"]; 
$friendsresult = $conn->query($fromuser);
$result = $conn->query($fromuser);
$result2 = $conn->query($fromuser);
if($result->num_rows>0) {
while($row = $result->fetch_assoc()) {
        $getsql = "SELECT id, username from users where id=".$row['fromuser'];  
        $result2 = $conn->query($getsql);
        $row2 = $result2->fetch_assoc();
        echo "<b>".$row2['username']."</b> wants to be friends with you."."<form action='friendrequests.php' method='post'><button name='acceptfr' value=".$row2['id'].">Accept</button><button name='declinefr' value=".$row2['id'].">Decline</button></form>";

    }
}

if($result2->num_rows>0) {
while($row = $result2->fetch_assoc()) {
        $getsql = "SELECT id, username from users where id=".$row['touser'];  
        $result2 = $conn->query($getsql);
        $row2 = $result2->fetch_assoc();
        echo "<b>".$row2['username']."</b> accepted your friend request."."<form action='friendrequests.php' method='post'><button name='acceptfr' value=".$row2['id'].">Accept</button><button name='declinefr' value=".$row2['id'].">Decline</button></form>";

    }
}

$conn->close();
}
?>
<?php 
session_start();
require_once('credentials.php');
// Create connection
$conn = new mysqli($servername, $dbusername, $password, $dbname);

return showrequestscount($conn);
function showrequestscount ($conn) {

$fromuser = "SELECT fromuser from messages where type=0 and touser=".$_SESSION['id']; 
$result = $conn->query($fromuser);
$friends = "SELECT touser from users where type=0 and fromuser=".$_SESSION['id']; 
$friendsresult = $conn->query($fromuser);
$result = $conn->query($fromuser);
$result2 = $conn->query($friends);
$count = 0;
if($result->num_rows>0) {
while($row = $result->fetch_assoc()) {
        $getsql = "SELECT  count(*) from users where id=".$row['fromuser'];  
        $result3 = $conn->query($getsql);
        $row2 = $result3->fetch_assoc();
        $count+=$row2['count(*)'];
    }
}
if($result2)
if($result2->num_rows>0) {
while($row = $result2->fetch_assoc()) {
        $getsql = "SELECT count(*) from users where id=".$row['touser'];  
        $result3 = $conn->query($getsql);
        $row2 = $result3->fetch_assoc();
        $count+=$row2['count(*)'];

    }
}
echo $count;
return $count;
$conn->close();
}
// ?>
<?php 
session_start();
require_once('credentials.php');
// Create connection
$conn = new mysqli($servername, $dbusername, $password, $dbname);
getfriends($conn);

function getfriends ($conn) {


$getsql = "SELECT userA,userB from friends where userA =".$_SESSION['id'];  
$result = $conn->query($getsql);

if($result->num_rows>0) {
while($row = $result->fetch_assoc()) {
      echo "<form action = 'php/addfriend.php' method='post'><h1>";
                if ($_SESSION['id'] == $row['userA'])
        $usernamecurrent = $row['userB'];
                else 
        $usernamecurrent = $row['userA'];
        
        $getsql2 = "SELECT username from users where id=".$usernamecurrent;  
        $result2 = $conn->query($getsql2);
        $row2 = $result2->fetch_assoc();


        
        echo $row2['username']." <button class='btn btn-lg' name='message' value=" .$row["id"]. " >Message</button><button class='btn btn-lg' name='requestmeeting' value=" .$row["id"]. " >Request Meeting</button><br>";
    }
    echo "</form>";
}
$conn->close();
}
?>
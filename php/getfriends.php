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
        
        $getsql2 = "SELECT username,id from users where id=".$row['userB'];  
        $result2 = $conn->query($getsql2);
        $row2 = $result2->fetch_assoc();
        

//         <button class='btn btn-lg' name='message' value=" .$row2["id"]. " >Message</button><button class='btn btn-lg' name='requestmeeting' value=" .$row["id"]. " >Request Meeting</button>
        echo $row2['username']." <br>";
    }
    echo "</form>";
}
$conn->close();
}
?>
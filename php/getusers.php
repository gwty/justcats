<?php 
session_start();
require('credentials.php'); 
$conn = new mysqli($servername, $dbusername, $password, $dbname);
getusers($conn);

function getusers ($conn) {
$getsql = "SELECT id,username,email from users where id <>".$_SESSION["id"];  
$result = $conn->query($getsql);
if($result->num_rows>0) {
while($row = $result->fetch_assoc()) {

        echo "<form action = 'php/addfriend.php' method='post'><h1>";
        $selectsql = "SELECT id from messages where fromuser = ".$_SESSION["id"]." and touser = ".$row["id"];
        $result2 = $conn->query($selectsql);
                $selectsql2 = "SELECT id from messages where touser = ".$_SESSION["id"]." and fromuser = ".$row["id"];
        $result3 = $conn->query($selectsql2);
        
//         // if did not send/receive FR
//         if ($result2->num_rows==0 && $result3->num_rows==0) 
        $sendfr = "<br><button class='btn btn-lg' name='addfriend' value=" .$row["id"].">See Profile</button>";
// ==
        
        echo $row['username']. $sendfr . " <button class='btn btn-lg' name='message' value=" .$row["id"]. " >say Hi</button>";
        echo "</form>";
    }
    
}
$conn->close();
}
?>
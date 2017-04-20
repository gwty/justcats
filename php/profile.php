<?php 
    session_start();
require('credentials.php'); 
$conn = new mysqli($servername, $dbusername, $password, $dbname);
if (isset($_POST["profileid"])) {

$getsql = "SELECT username,name,company from users where id =".$_POST["profileid"];

$result = $conn->query($getsql);
if($result)
$row = $result->fetch_assoc();
echo "<h1>";
echo "Username : ".$row['username']."<br>";
echo "Name : ".$row['name']."<br>";
echo "Company: ".$row['company']."<br>";
echo "</h1>";
?>
<form id="addfriends" ONSUBMIT="submitfriends(); return false;" method="post">
<button class ="btn btn-lg" name="addfriend"  value = "<?php echo $_POST["profileid"] ?>"><img src="img/buttons/addfriend.png" width="150px"/></button>
</form>

               <script>
           function submitfriends() {
           var id = $('button[name="addfriend"]').val();
    $.ajax({
        type: 'POST',
        url: 'php/addfriend.php',
        data:{'addfriend':id},
        success: function(data)
        {
                alert("Sent a friend request");
                  var data;
  $.get( "php/getusers.php", function( data ) {$( "#userslist" ).html( data );});

                closepage("userprofile");
        }
    });}
           </script>
<?php 
}

$conn->close();
?>
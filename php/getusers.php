    <script src= "js/jquery-3.2.0.min.js"></script>
    <script src= "js/jquery.form.js"></script>
    <script src= "js/gameelements.js"></script>
    <link href="css/game.css" rel="stylesheet" />
    <?php 
    session_start();
require('credentials.php'); 

$conn = new mysqli($servername, $dbusername, $password, $dbname);
getusers($conn);

function getusers ($conn) {
$getsql = "SELECT id,username,name,company,picture from users where id <>".$_SESSION["id"]; 

?>


<div class="container">
<button class='close2' onclick='closepage("usersearch")'>Close</button><br><br><br>
<div class="col-sm-8 col-md-8 col-lg-8">
<input name='findpeople'  style="width:70%;" class='form-control' placeholder='Find people by name, company, position'></input>      

<button type="submit" class="btn btn-default btn-md">
          <span class="glyphicon glyphicon-search"></span> Search 
        </button>
</div>
</div>
<form id="users" ONSUBMIT="submitme(); return false;" method="post">
<script> 
 var clickedone=0; 
 var clickedhi=0;

function clickme(element){
 clickedone = element;
}

function clickmehi(element){
 clickedhi = element;
}

function getclickme(){
return clickedone;
}

function getclickhi(){
return clickedhi;
}

</script>

<div class="circle">Position</div>
<div class="circle">Skills</div>
<div class="circle">Hobbies</div>
<div class="circle">Location</div>
<br>
<br>
<?php
echo "<table style='width:100%'>";
$result = $conn->query($getsql);

if($result->num_rows>0) {

while($row = $result->fetch_assoc()) {
echo "<tr>";
        $selectsql = "SELECT id from friends where fromuser = ".$_SESSION["id"]." and touser = ".$row["id"];
        $sendfr= "";
        $result2 = $conn->query($selectsql);
          if ($result2->num_rows==0) 
        $sendfr = "<button class='btn btn-md' type='submit' onclick='clickme(".$row["id"].")' name='profileid' value=" .$row["id"].">See Profile</button>";
        ?>

        
        
        <?php 
//         if($row['picture']!='')
        echo "<td><img height=60px src='avatar.png'/ style='margin-right:20px;'></td><td>";
        
        
        
        echo "<b>". $row['username']. "<br>". $row['name']."<br>".$row['company']."</b><hr><td>  ". $sendfr . " <img onclick='clickmehi(".$row["id"].")' src='img/buttons/sayhi.png' width='60px'</img><br></tr></td>";
    }
    ?>
    </form>
               <script>
           function submitme() {
           var id = getclickme();
           var id2 =getclickhi();
           if(id!=0) {
    $.ajax({
        type: 'POST',
        url: 'php/profile.php',
        data:{'profileid':id},
        success: function(data)
        {
                openpage("userprofile");
            $("#profileinfo").html(data);
        }
    });
    }
    if(id2!=0) {
                openpage("sendacat");
//             $("#sendmessage").html(data);
    
    }
    }
           </script>
 
 
            
        <?php
    
}
$conn->close();
}
?>
</table>


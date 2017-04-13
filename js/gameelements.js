    function closepage(element) {
    document.getElementById(element).style='visibility:hidden';
    }

    function closeprofile(){
    document.getElementById("profile").style='visibility:hidden';
    }
    
       
    
    function closecat(){
    document.getElementById("mycat").style='visibility:hidden';
    }
    
    function sendfr() {
    document.getElementById("potentialfriends").style='display:block';
    }
    
        function feedcat() {
    if(selectedcat.hunger>20)
        selectedcat.hunger-=20;
    }
    
    function closebutton(element) {
     document.write(" <button class='close2' onclick='closepage("+element+")>Close</button>");
    }
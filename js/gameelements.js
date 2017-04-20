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
<<<<<<< HEAD
    }
    function openpage(element) {
    el = document.getElementById(element);
    if(el) {
    el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
    window.scrollTo(0, 0);
    }
    else {
      console.log ("element not found");
    }
}
=======
    }
>>>>>>> 03f0905f8bce38b69adae491af2a0dcd2ce6bf6c

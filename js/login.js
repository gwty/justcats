function liAuth(){
  IN.User.authorize(function(){
  });
}
// Setup an event listener to make an API call once auth is complete
function onLinkedInLoad() {
  IN.Event.on(IN, "auth", getProfileData);
}

// Handle the successful return from the API call
function onSuccess(data) {
  console.log(data);      
}

// Handle an error response from the API call
function onError(error) {
  console.log(error);
}

function exists(element) {
  var exists = 0;
  var element =  document.getElementById(element);
if (typeof(element) != 'undefined' && element != null)
{
  exists = 1;// exists.
}
return exists;
}
// Use the API call wrapper to request the member's basic profile data
function getProfileData() {
  IN.API.Profile("me").fields("id,firstName,lastName,email-address,summary,picture-urls::(original),public-profile-url,location:(name),positions:(is-current,company:(name),title)").result(function (me) {
    var profile = me.values[0];
    var id = profile.id;
    var firstName = profile.firstName;
    var lastName = profile.lastName;
    var emailAddress = profile.emailAddress;
    var pictureUrl = profile.pictureUrls.values[0];
    var profileUrl = profile.publicProfileUrl;
    var country = profile.location.name;
    var company = profile.positions.values[0].company.name;
    var position = profile.positions.values[0].title;
    var summary = profile.summary;
    
    if(exists("Company"))
    document.getElementById("Company").value =  company;
<<<<<<< HEAD
    
        if(exists("Company2"))
    document.getElementById("Company2").value =  company;
=======
>>>>>>> 03f0905f8bce38b69adae491af2a0dcd2ce6bf6c
    if(exists("Title"))
    document.getElementById("Title").value =  position;
    if(exists("Summary"))
      document.getElementById("Summary").value =  summary;
    if(exists("Email"))
    document.getElementById("Email").value =  emailAddress;
    if(exists("Name"))
    document.getElementById("Name").value =  firstName + " " + lastName;
<<<<<<< HEAD
    
        if(exists("Name2"))
    document.getElementById("Name2").value =  firstName + " " + lastName;
    
    
=======
>>>>>>> 03f0905f8bce38b69adae491af2a0dcd2ce6bf6c
    if(exists("picture"))
    document.getElementById("picture").src =  pictureUrl;
  });
} 

function eraseCookie(name) {
    createCookie(name,"",-1);
}
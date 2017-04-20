var game = new Phaser.Game(1600, 2400, Phaser.CANVAS, 'gameDiv', { preload: preload, create: create, update: update , render: render}, 'true');

function preload() {
var room =game.load.image('room', 'img/FullSizeRender.jpg');
game.load.image('black', 'img/black.png');

game.load.image('cat0', 'img/cat1.png'); 
game.load.image('cat1', 'img/cat2.png'); 
game.load.image('cat2', 'img/cat3.png'); 

game.load.image('home1', 'img/home1.png');
game.load.image('fish', 'img/fish.png');
game.load.image('box', 'img/box.png');
game.load.image('bigbox', 'img/bigbox.png');
game.load.image('usersearch', 'img/user_search.png');
game.load.image('coin', 'img/coin.png');
game.load.image('bar', 'img/bar.png');

game.load.image('friends', 'img/friends.png');
game.load.image('help', 'img/help.png');
game.load.image('settings', 'img/settings.png');
game.load.image('profile', 'img/profile.png');

game.load.image('feed', 'img/feed.png');
game.load.image('tricks', 'img/tricks.png');
game.load.image('customize', 'img/customize.png');

game.scale.scaleMode = Phaser.ScaleManager.SHOW_ALL;
// game.scale.pageAlignVertically = true;
game.scale.pageAlignHorizontally = true;
game.scale.setMinMax(game.width/6, game.height/6, game.width*2, game.height*2);
game.scale.refresh();

}

var bigboxenabled = 0;
var bigbox, friends, help, settings, profile;
var background, home1, box, usersearch, fish, coin, feed, tricks, customize;
var friends;
var mycat = [];
var no_of_cats = 3;
var menuposincr = game.width/4+70, menuposspace = 100, mysize = game.width/4;
var i;
var hunger, health, education, feedhunger, trickseducation;
var selectedcat;
var notiftext;

function adjustsize(elementlist)  {
for (var i = 0; i<elementlist.length; i++ ) {
 elementlist[i].width=mysize;
 elementlist[i].height=mysize;
 }
 
  coin.width=mysize*2;
  coin.height=mysize;
  
    fish.width=mysize*1.5;
  fish.height=mysize;
  
   usersearch.width=mysize*0.75;
  usersearch.height=mysize*1.25;
}

function setcatalpha (alpha) {
for (i =0; i< no_of_cats; i++) {
  mycat[i].alpha= alpha;
  }
}

function rotateme(sprite, pointer, angle) {
  game.add.tween(sprite).to( { angle:  angle}, 2000, Phaser.Easing.Linear.None, true);
}

function addcatanimation () {
for (i= 0; i < no_of_cats; i++) {
mycat[i].inputEnabled = true;
mycat[i].input.enableDrag(true);
// jump = game.add.tween(mycat[i]).to( { x: [ mycat[i].x, mycat[i].x, mycat[i].x, mycat[i].x ], y: [ mycat[i].y, mycat[i].y, mycat[i].y-100, mycat[i].y ] }, 500, "Linear", true, 4, false);
mycat[i].events.onDragStart.add (rotateme,this, 360); 
mycat[i].events.onDragStop.add (rotateme,this, 0); 
mycat[i].health = 100;
mycat[i].hunger = 40;
mycat[i].education = 100;

}   
}

function usersearchfunction(sprite, pointer) {
  var data;
  $.get( "../justcats/php/getusers.php", function( data ) {$( "#userslist" ).html( data );});

    openpage("usersearch");
}

function feedfunction(sprite, pointer) {
    openpage("feed");
    document.getElementById('selectedcat').src = selectedcat._frame.name;

}

function tricksfunction(sprite, pointer) {
    openpage("trickseducationpage");
    document.getElementById('selectedcattrick').src = selectedcat._frame.name;

}

function messagesfunction(sprite, pointer) {
  var data;
  $.get( "../justcats/php/showrequests.php", function( data ) {$( "#notifications" ).html( data );});
        
    openpage("messages");
//    document.getElementById('selectedcat2').src = selectedcat._frame.name;

}

function shopfunction(sprite, pointer) {
    openpage("shop");
//     document.getElementById('selectedcat2').src = selectedcat._frame.name;

}

function customizefunction(sprite, pointer) {
    openpage("customize");
    document.getElementById('selectedcat3').src = selectedcat._frame.name;

}

function displayfriends(sprite, pointer) {
  
    var data;
  $.get( "../justcats/php/getfriends.php", function( data ) {
  $( "#myfriends" ).html( data );
});
    openpage("friendslist");

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

function openprofile(sprite, pointer) {
    openpage("profile");
}


function opencatpage(sprite, pointer) {
//     openpage("mycat");
    health = sprite.health;
    education = sprite.education;
    hunger = sprite.hunger;
    feedhunger = sprite.hunger;
    trickseducation = sprite.education;
    
    document.getElementById('health').innerHTML = health;
    document.getElementById('education').innerHTML = education;
    document.getElementById('hunger').innerHTML = hunger;
//     document.getElementById('feedhunger').innerHTML = feedhunger;
//         document.getElementById('trickseducationpage').innerHTML = trickseducation;

    document.getElementById('currentcat').src = sprite._frame.name;
    selectedcat = sprite;
    selecttext.destroy();
}

function enlargebox(sprite, pointer) {
  if(bigboxenabled == 0) {
    
  bigbox = game.add.sprite(game.width/4, game.height/2, 'bigbox');
  friends = game.add.sprite(game.width/2, game.height/3+500, 'friends');
  help = game.add.sprite(game.width/2+300, game.height/4+500, 'help');
  settings = game.add.sprite(game.width/4+80, game.height/3+500, 'settings');
  profile = game.add.sprite(game.width/4+300, game.height/4+400, 'profile');
  elementlist= [friends,help,settings,profile];
  adjustsize(elementlist);
  profile.inputEnabled = true;
  profile.events.onInputDown.add(openprofile, this);
  bigbox.height=game.width/1.5;;
  bigbox.width=game.width/2;;
  bigboxenabled = 1;
  background.alpha=0.3;;
  setcatalpha(0);
  friends.inputEnabled = true;
  friends.events.onInputDown.add(displayfriends, this);
 }
  else {
    bigbox.destroy();
    friends.destroy();
    help.destroy();
    settings.destroy();
    profile.destroy();
    bigboxenabled = 0;
    background.alpha =1;
    setcatalpha(1);
  }
}

function create() {
background = game.add.tileSprite(0, 0, 1600, 2400, "room");
background.scale.x = background.scale.x*2.3;
background.scale.y = background.scale.y*2.5;

for (i=0; i < no_of_cats ; i++)  {
mycat[i] = game.add.sprite( Math.random() * (game.width-400), 1020 + Math.random() * 400, 'cat'+i);
}


home1 = game.add.sprite(0, 0, 'home1');
box = game.add.sprite(menuposincr, 0, 'box');
usersearch = game.add.sprite(2*menuposincr+30, 0, 'usersearch');
fish = game.add.sprite(3*menuposincr, 0, 'fish');
coin = game.add.sprite(4*menuposincr+menuposspace, 0, 'coin');

// feed = game.add.sprite(0*menuposincr, game.height-300, 'feed');
// tricks = game.add.sprite(2*menuposincr, game.height-300, 'tricks');
// customize = game.add.sprite(4*menuposincr, game.height-300, 'customize');

elementlist = [home1,box,usersearch];
adjustsize(elementlist);
addcatanimation();


text = game.add.text(4*menuposincr+350, 90, '123');
text.anchor.set(0.5);
text.align = 'center';
text.font = 'Comic Sans MS';
text.fontSize = 70;
text.fontWeight = 'normal';
text.fill = '#000000';

    
var timer, delay = 5000;
notiftext = game.add.text(3*menuposincr+80, 150, '');
notiftext.anchor.set(0.5);
notiftext.align = 'center';
notiftext.font = 'Arial Black';
notiftext.fontSize = 90;
notiftext.fontWeight = 'bold';
notiftext.fill = '#dd2211';

    $.ajax({
      type    : 'GET',
      url     : 'php/update.php',
      data    : count,
      success : function(count){
                  notiftext.setText(count);
                }
    });
    
var count;
timer = setInterval(function(){
    $.ajax({
      type    : 'GET',
      url     : 'php/update.php',
      data    : count,
      success : function(count){
                  notiftext.setText(count);
                }
    });
}, delay);



function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}


var username = getCookie("username");
var welcome = 'Hi ' + username + ', select a cat and play with him/her.';
selecttext = game.add.text(700, 650, welcome );
selecttext.anchor.set(0.5);
selecttext.align = 'center';
selecttext.font = 'Comic Sans MS';
selecttext.fontSize = 70;
// selecttext.fontWeight = 'bold';
selecttext.fill = '#ffffff';
selecttext.style.backgroundColor = "#000000";


box.inputEnabled = true;
usersearch.inputEnabled = true;
// feed.inputEnabled = true;
// tricks.inputEnabled = true;
fish.inputEnabled = true;
coin.inputEnabled = true;
// customize.inputEnabled = true;

box.events.onInputDown.add(enlargebox, this);
usersearch.events.onInputDown.add(usersearchfunction, this);
// feed.events.onInputDown.add(feedfunction, this);
// tricks.events.onInputDown.add(tricksfunction, this);
fish.events.onInputDown.add(messagesfunction, this);
coin.events.onInputDown.add(shopfunction, this);
// customize.events.onInputDown.add(customizefunction, this);


for (i=0;i<no_of_cats;i++) {
 mycat[i].inputEnabled = true;
 mycat[i].events.onInputDown.add(opencatpage,this);
 mycat[i].events.onInputUp.add(closecat,this);
}

}

function update() {
}

function render() {

//     game.debug.inputInfo(32, 32);
//     game.debug.pointer( game.input.activePointer );
//     var myfps = game.debug.text(game.time.fps, 100, 100, 'black');
} 

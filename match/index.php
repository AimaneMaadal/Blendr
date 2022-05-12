<?php 
  session_start();
  include_once "../classes/user.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: http://localhost/blendr2.0/match.php");
  }
  
  $data = User::getAllUsers();




// echo $_SESSION['unique_id'];

$geo = User::getUserByUniqueId($_SESSION['unique_id'])[0]['geo'];

$lat1 = json_decode($geo)[0];
$long1 = json_decode($geo)[1];

//echo $lat1." ".$long1;

function distance($lat1, $lon1, $lat2, $lon2, $unit) {

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);
  
    if ($unit == "K") {
        return round($miles * 1.609344);
    } else if ($unit == "N") {
        return round($miles * 0.8684);
    } else {
        return round($miles);
    }
  }

  $usersNew = [];
  foreach($data as $user){
      //push to array
      array_push($usersNew, $user['unique_id']);
  }

  //var_dump($usersNew);


?>
<?php include_once "../header.php"; ?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blendr</title>
    <link rel="stylesheet" href="match.css">
    <link rel="stylesheet" href="../style.css">
    <script src="https://kit.fontawesome.com/6ec6696b28.js" crossorigin="anonymous"></script>
    <style>
        .card-item{
            /* background-image: url("../php/images/food2.jfif"); */
        }
        .pop_up{
            background-color: #FFE6AE;
            margin-bottom: 58px;
            margin-top: -53px;
            width: 75%;
            height: 54px;
            border-radius: 16px;
        }
        .pop_up>div{
            background-color: white;
            width: 40px;
            height: 40px;
            margin: 7px 3px 3px 9px;
            border-radius: 12px;
        }
        .pop_up h3 {
            float: left;
            margin: -38px 0px 0px 66px;
            color: #001F3B;
        }
        .pop_up p {
            float: left;
            margin: -23px 0px 0px 66px;
            color: #001F3B;
        }
        .pop_up>div i{
            color: #FFDD27;
            margin: 20px 0px 0px 7px;
        }
        .pop_up i {
            color: #ffffff;
            margin: -22px 0px 0px 257px;
            float: left;
        }
        .profilePic {
            background: white;
            width: 45px;
            height: 45px;
            margin: -100px -138px 80px -30px;
            border-radius: 425px;
            float: right;
        }
        .menu {
            float: left;
            margin: -85px 0px 0px -142px;
        }
    </style>    
<body>
<div class="wrapper">
<header>
<img src="../php/images/vector.svg" alt="logo" class="menu">
<?php echo'<img class="profilePic" id="profilePicture" data-id="'.$_SESSION["unique_id"].'" src="../php/images/' .$data[0]['img']. '" alt="">'; ?>
        <div class="content">
        <!-- <a href="php/logout.php?logout_id=<?php echo $_SESSION['unique_id'] ?>" class="logout">Logout</a> -->
    </header>
        <div class="pop_up"><div><i class="fa-solid fa-crown fa-2xl" style="width:100%"></i></div><h3>Upgrade naar premium</h3><p>Ontmoet nieuwe mensen</p><i class="fa-solid fa-xmark fa-xl"></i></div>
    <div id="stacked-cards-block" class="stackedcards stackedcards--animatable init">
  <div class="stackedcards-container">
    <?php foreach($data as $row){ 
        $lat2 = json_decode($row['geo'])[0];
        $long2 = json_decode($row['geo'])[1];
        $img = "../php/images/".json_decode($row["showcase"])[0];            
        echo '<div class="card-item" style="background-image:url(\'' .$img. '\'); background-position: center;  background-size: cover;" ><a href="profilepage.php?id='.$row["unique_id"].'">oo</a>
            <div class="card-inner" onclick="link()"><a href="profilepage.php?id='.$row["user_id"].'">
                <img data-id="'.$row["user_id"].'" src="../php/images/' .$row["img"]. '" alt="" id="profilePicture2">
                <div class="userInfo">
                <h3>' .$row["fname"].' '.distance($lat1, $long1, $lat2, $long2, "K").'km</h3>
                Mechelen
                </a></div>
            </div>
        </div>';
    } 
    ?>
    
  </div>
 
  <div class="stackedcards--animatable stackedcards-overlay top">TOP</div>
  <div class="stackedcards--animatable stackedcards-overlay right">RIGHT</div>
  <div class="stackedcards--animatable stackedcards-overlay left">LEFT</div>
</div>
<div class="global-actions">
  <div class="left-action">Left</div>
  <div class="top-action" id="topButton"><img src="../php/images/pot.svg"></img></div>
  <div class="right-action">Right</div>
</div>





<script>

    // JavaScript Document
document.addEventListener("DOMContentLoaded", function(event) {


    
function stackedCards () {

    var stackedOptions = 'Top'; //Change stacked cards view from 'Bottom', 'Top' or 'None'.
    var rotate = true; //Activate the elements' rotation for each move on stacked cards.
    var items = 3; //Number of visible elements when the stacked options are bottom or top.
    var elementsMargin = -20; //Define the distance of each element when the stacked options are bottom or top.
    var useOverlays = true; //Enable or disable the overlays for swipe elements.
    var maxElements; //Total of stacked cards on DOM.
    var currentPosition = 0; //Keep the position of active stacked card.
    var velocity = 0.3; //Minimum velocity allowed to trigger a swipe.
    var topObj; //Keep the swipe top properties.
    var rightObj; //Keep the swipe right properties.
    var leftObj; //Keep the swipe left properties.
    var listElNodesObj; //Keep the list of nodes from stacked cards.
    var listElNodesWidth; //Keep the stacked cards width.
    var currentElementObj; //Keep the stacked card element to swipe.
    var stackedCardsObj;
    var isFirstTime = true;
    var elementHeight;
    var obj;
    var elTrans;
    var counter = 0;
    var UsersArr = <?php echo json_encode($usersNew); ?>;
    var Userlenght = UsersArr.length;

    
    obj = document.getElementById('stacked-cards-block');
    stackedCardsObj = obj.querySelector('.stackedcards-container');
    listElNodesObj = stackedCardsObj.children;
    
    topObj = obj.querySelector('.stackedcards-overlay.top');
    rightObj = obj.querySelector('.stackedcards-overlay.right');
    leftObj = obj.querySelector('.stackedcards-overlay.left');
    
    countElements();
    currentElement();
    listElNodesWidth = stackedCardsObj.offsetWidth;
    currentElementObj = listElNodesObj[0];
    updateUi();
    
    //Prepare elements on DOM
    addMargin = elementsMargin * (items -1) + 'px';
    
    if(stackedOptions === "Top"){

        for(i = items; i < maxElements; i++){
            listElNodesObj[i].classList.add('stackedcards-top', 'stackedcards--animatable', 'stackedcards-origin-top');
        }
        
        elTrans = elementsMargin * (items - 1);
        
        stackedCardsObj.style.marginBottom = addMargin;
        
    } else if(stackedOptions === "Bottom"){
        
        
        for(i = items; i < maxElements; i++){
            listElNodesObj[i].classList.add('stackedcards-bottom', 'stackedcards--animatable', 'stackedcards-origin-bottom');
        }
        
        elTrans = 0;
        
        stackedCardsObj.style.marginBottom = addMargin;
        
    } else if (stackedOptions === "None"){
        
        for(i = items; i < maxElements; i++){
            listElNodesObj[i].classList.add('stackedcards-none', 'stackedcards--animatable');
        }
        
        elTrans = 0;
    
    }
        
    for(i = items; i < maxElements; i++){
        listElNodesObj[i].style.zIndex = 0;
        listElNodesObj[i].style.opacity = 0;
        listElNodesObj[i].style.webkitTransform ='scale(' + (1 - (items * 0.04)) +') translateX(0) translateY(' + elTrans + 'px) translateZ(0)';
        listElNodesObj[i].style.transform ='scale(' + (1 - (items * 0.04)) +') translateX(0) translateY(' + elTrans + 'px) translateZ(0)';
    }
    
    if(listElNodesObj[currentPosition]){
        listElNodesObj[currentPosition].classList.add('stackedcards-active');
    }
    
    if(useOverlays){
        leftObj.style.transform = 'translateX(0px) translateY(' + elTrans + 'px) translateZ(0px) rotate(0deg)';
        leftObj.style.webkitTransform = 'translateX(0px) translateY(' + elTrans + 'px) translateZ(0px) rotate(0deg)';
        
        rightObj.style.transform = 'translateX(0px) translateY(' + elTrans + 'px) translateZ(0px) rotate(0deg)';
        rightObj.style.webkitTransform = 'translateX(0px) translateY(' + elTrans + 'px) translateZ(0px) rotate(0deg)';
        
        topObj.style.transform = 'translateX(0px) translateY(' + elTrans + 'px) translateZ(0px) rotate(0deg)';
        topObj.style.webkitTransform = 'translateX(0px) translateY(' + elTrans + 'px) translateZ(0px) rotate(0deg)';
        
    } else {
        leftObj.className = '';
        rightObj.className = '';
        topObj.className = '';
        
        leftObj.classList.add('stackedcards-overlay-hidden');
        rightObj.classList.add('stackedcards-overlay-hidden');
        topObj.classList.add('stackedcards-overlay-hidden');
    }
    
    //Remove class init
    setTimeout(function() {
        obj.classList.remove('init');
    },150);
    
    
    function backToMiddle() {

        removeNoTransition();
        transformUi(0, 0, 1, currentElementObj); 

        if(useOverlays){
            transformUi(0, 0, 0, leftObj);
            transformUi(0, 0, 0, rightObj);
            transformUi(0, 0, 0, topObj);
        }

        setZindex(5);

        if(!(currentPosition >= maxElements)){
            //roll back the opacity of second element
            if((currentPosition + 1) < maxElements){
                listElNodesObj[currentPosition + 1].style.opacity = '.8';
            }
        }
    };
    
    // Usable functions
    function countElements() {
        maxElements = listElNodesObj.length;
        if(items > maxElements){
            items = maxElements;
        }
    };
    
    //Keep the active card.
    function currentElement() {
      currentElementObj = listElNodesObj[currentPosition];  
    };
    
    //Functions to swipe left elements on logic external action.
    function onActionLeft() {
        if(!(currentPosition >= maxElements)){
            if(useOverlays) {
                leftObj.classList.remove('no-transition');
                topObj.classList.remove('no-transition');
                leftObj.style.zIndex = '8';
                transformUi(0, 0, 1, leftObj);

            }
            
            setTimeout(function() {
                onSwipeLeft();
                resetOverlayLeft();
            },300);
        }
    };
    
    //Functions to swipe right elements on logic external action.
    function onActionRight() {
        if(!(currentPosition >= maxElements)){
            if(useOverlays) {
                rightObj.classList.remove('no-transition');
                topObj.classList.remove('no-transition');
                rightObj.style.zIndex = '8';
                transformUi(0, 0, 1, rightObj);
            }

            setTimeout(function(){
                onSwipeRight();
                resetOverlayRight();
            },300);
        }

    };
    
    //Functions to swipe top elements on logic external action.
    function onActionTop() {
        // const xhttp = new XMLHttpRequest();
        // xhttp.onload = function() {
        //     alert(this.responseText);
        // }
        // xhttp.open("GET", "ajax/add_match.php?id="+document.getElementById('profilePicture').getAttribute('data-id')+"&id2="+UsersArr[counter]+"&like=2", true);
        // xhttp.send();

        if(!(currentPosition >= maxElements)){
            if(useOverlays) {
                leftObj.classList.remove('no-transition');
                rightObj.classList.remove('no-transition');
                topObj.classList.remove('no-transition');
                topObj.style.zIndex = '8';
                transformUi(0, 0, 1, topObj);
            }
            
            setTimeout(function(){
                onSwipeTop();
                resetOverlays();
            },300); //wait animations end
        }
    };
    
    //Swipe active card to left.
    function onSwipeLeft() {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            alert(this.responseText);
        }
        xhttp.open("GET", "ajax/add_match.php?id="+document.getElementById('profilePicture').getAttribute('data-id')+"&id2="+UsersArr[counter]+"&like=0", true);
        xhttp.send();

        removeNoTransition();
        transformUi(-1000, 0, 0, currentElementObj);
        if(useOverlays){
            transformUi(-1000, 0, 0, leftObj); //Move leftOverlay
            transformUi(-1000, 0, 0, topObj); //Move topOverlay
            resetOverlayLeft();
        }
        currentPosition = currentPosition + 1;
        updateUi();
        currentElement();
        setActiveHidden();
    };
    
    //Swipe active card to right.
    function onSwipeRight() {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            alert(this.responseText);
        }
        xhttp.open("GET", "ajax/add_match.php?id="+document.getElementById('profilePicture').getAttribute('data-id')+"&id2="+UsersArr[counter]+"&like=1", true);
        xhttp.send();

        removeNoTransition();
        transformUi(1000, 0, 0, currentElementObj);
        if(useOverlays){
            transformUi(1000, 0, 0, rightObj); //Move rightOverlay
            transformUi(1000, 0, 0, topObj); //Move topOverlay
            resetOverlayRight();
        }

        currentPosition = currentPosition + 1;
        updateUi();
        currentElement();
        setActiveHidden();
    };
    
    //Swipe active card to top.
    function onSwipeTop() {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            alert(this.responseText);
        }
        xhttp.open("GET", "ajax/add_match.php?id="+document.getElementById('profilePicture').getAttribute('data-id')+"&id2="+UsersArr[counter]+"&like=2", true);
        xhttp.send();

        removeNoTransition();
        transformUi(0, -1000, 0, currentElementObj);
        if(useOverlays){
            transformUi(0, -1000, 0, leftObj); //Move leftOverlay
            transformUi(0, -1000, 0, rightObj); //Move rightOverlay
            transformUi(0, -1000, 0, topObj); //Move topOverlay
            resetOverlays();
        }

        currentPosition = currentPosition + 1;
        updateUi();
        currentElement();
        setActiveHidden();
    };
    
    //Remove transitions from all elements to be moved in each swipe movement to improve perfomance of stacked cards.
    function removeNoTransition() {
        if(listElNodesObj[currentPosition]){
            
            if(useOverlays) {
                leftObj.classList.remove('no-transition');
                rightObj.classList.remove('no-transition');
                topObj.classList.remove('no-transition');
            }
            
            listElNodesObj[currentPosition].classList.remove('no-transition');
            listElNodesObj[currentPosition].style.zIndex = 6;
        }
        
    };

    //Move the overlay left to initial position.
    function resetOverlayLeft() {
        if(!(currentPosition >= maxElements)){
            if(useOverlays){
                setTimeout(function(){
                    
                    if(stackedOptions === "Top"){
                        
                        elTrans = elementsMargin * (items - 1);
                    
                    } else if(stackedOptions === "Bottom" || stackedOptions === "None"){
                        
                        elTrans = 0;
                    
                    }
                    
                    if(!isFirstTime){
                        
                        leftObj.classList.add('no-transition');
                        topObj.classList.add('no-transition');
                        
                    }
                    
                    requestAnimationFrame(function(){
                        
                        leftObj.style.transform = "translateX(0) translateY(" + elTrans + "px) translateZ(0)";
                        leftObj.style.webkitTransform = "translateX(0) translateY(" + elTrans + "px) translateZ(0)";
                        leftObj.style.opacity = '0';
                        
                        topObj.style.transform = "translateX(0) translateY(" + elTrans + "px) translateZ(0)";
                        topObj.style.webkitTransform = "translateX(0) translateY(" + elTrans + "px) translateZ(0)";
                        topObj.style.opacity = '0';
                    
                    });
                    
                },300);
                
                isFirstTime = false;
            }
        }
   };
   
    //Move the overlay right to initial position.
    function resetOverlayRight() {
        if(!(currentPosition >= maxElements)){
            if(useOverlays){
                setTimeout(function(){
                    
                    if(stackedOptions === "Top"){+2
                        
                        elTrans = elementsMargin * (items - 1);
                    
                    } else if(stackedOptions === "Bottom" || stackedOptions === "None"){
                        
                        elTrans = 0;
                    
                    }
                    
                    if(!isFirstTime){
                        
                        rightObj.classList.add('no-transition');
                        topObj.classList.add('no-transition');
                        
                    }
                    
                    requestAnimationFrame(function(){
                        
                        rightObj.style.transform = "translateX(0) translateY(" + elTrans + "px) translateZ(0)";
                        rightObj.style.webkitTransform = "translateX(0) translateY(" + elTrans + "px) translateZ(0)";
                        rightObj.style.opacity = '0';
                        
                        topObj.style.transform = "translateX(0) translateY(" + elTrans + "px) translateZ(0)";
                        topObj.style.webkitTransform = "translateX(0) translateY(" + elTrans + "px) translateZ(0)";
                        topObj.style.opacity = '0';
                    
                    });

                },300);
                
                isFirstTime = false;
            }
        }
   };
   
    //Move the overlays to initial position.
    function resetOverlays() {
        if(!(currentPosition >= maxElements)){
            if(useOverlays){

                setTimeout(function(){
                    if(stackedOptions === "Top"){
                        
                        elTrans = elementsMargin * (items - 1);
                    
                    } else if(stackedOptions === "Bottom" || stackedOptions === "None"){

                        elTrans = 0;

                    }
                    
                    if(!isFirstTime){

                        leftObj.classList.add('no-transition');
                        rightObj.classList.add('no-transition');
                        topObj.classList.add('no-transition');

                    }
                    
                    requestAnimationFrame(function(){

                        leftObj.style.transform = "translateX(0) translateY(" + elTrans + "px) translateZ(0)";
                        leftObj.style.webkitTransform = "translateX(0) translateY(" + elTrans + "px) translateZ(0)";
                        leftObj.style.opacity = '0';
                        
                        rightObj.style.transform = "translateX(0) translateY(" + elTrans + "px) translateZ(0)";
                        rightObj.style.webkitTransform = "translateX(0) translateY(" + elTrans + "px) translateZ(0)";
                        rightObj.style.opacity = '0';
                        
                        topObj.style.transform = "translateX(0) translateY(" + elTrans + "px) translateZ(0)";
                        topObj.style.webkitTransform = "translateX(0) translateY(" + elTrans + "px) translateZ(0)";
                        topObj.style.opacity = '0';

                    });

                },300);	// wait for animations time
                
                isFirstTime = false;							
            }
        }
   };
    
    function setActiveHidden() {
        if(!(currentPosition >= maxElements)){
            listElNodesObj[currentPosition - 1].classList.remove('stackedcards-active');
            listElNodesObj[currentPosition - 1].classList.add('stackedcards-hidden');
            listElNodesObj[currentPosition].classList.add('stackedcards-active');
            counter++;
        }		 
    };

    //Set the new z-index for specific card.
    function setZindex(zIndex) {
        if(listElNodesObj[currentPosition]){
            listElNodesObj[currentPosition].style.zIndex = zIndex;
        }		 
    };

// Remove element from the DOM after swipe. To use this method you need to call this function in onSwipeLeft, onSwipeRight and onSwipeTop and put the method just above the variable 'currentPosition = currentPosition + 1'. 
//On the actions onSwipeLeft, onSwipeRight and onSwipeTop you need to remove the currentPosition variable (currentPosition = currentPosition + 1) and the function setActiveHidden

    function removeElement() {
  currentElementObj.remove();
  if(!(currentPosition >= maxElements)){
            listElNodesObj[currentPosition].classList.add('stackedcards-active');
        }		
    };
    
    //Add translate X and Y to active card for each frame.
    function transformUi(moveX,moveY,opacity,elementObj) {
        requestAnimationFrame(function(){  
            var element = elementObj;
            
            // Function to generate rotate value 
            function RotateRegulator(value) {
               if(value/10 > 15) {
                   return 15;
               }
               else if(value/10 < -15) {
                   return -15;
               }
               return value/10;
            }
            
            if(rotate){
                rotateElement = RotateRegulator(moveX);
            } else {
                rotateElement = 0;
            }
            
            if(stackedOptions === "Top"){
                elTrans = elementsMargin * (items - 1);
                if(element){     
                    element.style.webkitTransform = "translateX(" + moveX + "px) translateY(" + (moveY + elTrans) + "px) translateZ(0) rotate(" + rotateElement + "deg)";
                    element.style.transform = "translateX(" + moveX + "px) translateY(" + (moveY + elTrans) + "px) translateZ(0) rotate(" + rotateElement + "deg)";
                    element.style.opacity = opacity;
                }
            } else if(stackedOptions === "Bottom" || stackedOptions === "None"){
                
                if(element){
                    element.style.webkitTransform = "translateX(" + moveX + "px) translateY(" + (moveY) + "px) translateZ(0) rotate(" + rotateElement + "deg)";
                    element.style.transform = "translateX(" + moveX + "px) translateY(" + (moveY) + "px) translateZ(0) rotate(" + rotateElement + "deg)";
                    element.style.opacity = opacity;
                }
            
            }
        });	  
    };

    //Action to update all elements on the DOM for each stacked card.
    function updateUi() {
        requestAnimationFrame(function(){
            elTrans = 0;
            var elZindex = 5;
            var elScale = 1;
            var elOpac = 1;
            var elTransTop = items;
            var elTransInc = elementsMargin;

            for(i = currentPosition; i < (currentPosition + items); i++){
                if(listElNodesObj[i]){
                    if(stackedOptions === "Top"){

                        listElNodesObj[i].classList.add('stackedcards-top', 'stackedcards--animatable', 'stackedcards-origin-top');

                        if(useOverlays){
                            leftObj.classList.add('stackedcards-origin-top');
                            rightObj.classList.add('stackedcards-origin-top');
                            topObj.classList.add('stackedcards-origin-top'); 
                        }

                        elTrans = elTransInc * elTransTop;
                        elTransTop--;

                    } else if(stackedOptions === "Bottom"){
                        listElNodesObj[i].classList.add('stackedcards-bottom', 'stackedcards--animatable', 'stackedcards-origin-bottom');

                        if(useOverlays){
                            leftObj.classList.add('stackedcards-origin-bottom');
                            rightObj.classList.add('stackedcards-origin-bottom');
                            topObj.classList.add('stackedcards-origin-bottom');
                        }

                        elTrans = elTrans + elTransInc;

                    } else if (stackedOptions === "None"){

                        listElNodesObj[i].classList.add('stackedcards-none', 'stackedcards--animatable');
                        elTrans = elTrans + elTransInc;

                    }

                    listElNodesObj[i].style.transform ='scale(' + elScale + ') translateX(0) translateY(' + (elTrans - elTransInc) + 'px) translateZ(0)';
                    listElNodesObj[i].style.webkitTransform ='scale(' + elScale + ') translateX(0) translateY(' + (elTrans - elTransInc) + 'px) translateZ(0)';
                    listElNodesObj[i].style.opacity = elOpac;
                    listElNodesObj[i].style.zIndex = elZindex;

                    elScale = elScale - 0.04;
                    elOpac = elOpac - (1 / items);
                    elZindex--;
                }
            }

        });
      
    };

    //Touch events block
    var element = obj;
    var startTime;
    var startX;
    var startY;
    var translateX;
    var translateY;
    var currentX;
    var currentY;
    var touchingElement = false;
    var timeTaken;
    var topOpacity;
    var rightOpacity;
    var leftOpacity;

    function setOverlayOpacity() {

        topOpacity = (((translateY + (elementHeight) / 2) / 100) * -1);
        rightOpacity = translateX / 100;
        leftOpacity = ((translateX / 100) * -1);
        

        if(topOpacity > 1) {
            topOpacity = 1;
        }

        if(rightOpacity > 1) {
            rightOpacity = 1;
        }

        if(leftOpacity > 1) {
            leftOpacity = 1;
        }
    }
    
    function gestureStart(evt) {
        startTime = new Date().getTime();
        
        startX = evt.changedTouches[0].clientX;
        startY = evt.changedTouches[0].clientY;
        
        currentX = startX;
        currentY = startY;

        setOverlayOpacity();
        
        touchingElement = true;
        if(!(currentPosition >= maxElements)){
            if(listElNodesObj[currentPosition]){
                listElNodesObj[currentPosition].classList.add('no-transition');
                setZindex(6);
                
                if(useOverlays){
                    leftObj.classList.add('no-transition');
                    rightObj.classList.add('no-transition');
                    topObj.classList.add('no-transition');
                }
                
                if((currentPosition + 1) < maxElements){
                    listElNodesObj[currentPosition + 1].style.opacity = '1';
                }
                
                elementHeight = listElNodesObj[currentPosition].offsetHeight / 3;
            }

        }
        
    };
    
    function gestureMove(evt) {
        currentX = evt.changedTouches[0].pageX;
        currentY = evt.changedTouches[0].pageY;
        
        translateX = currentX - startX;
        translateY = currentY - startY;

        setOverlayOpacity();
        
        if(!(currentPosition >= maxElements)){
            evt.preventDefault();
            transformUi(translateX, translateY, 1, currentElementObj);

            if(useOverlays){
                transformUi(translateX, translateY, topOpacity, topObj);

                if(translateX < 0){
                    transformUi(translateX, translateY, leftOpacity, leftObj);
                    transformUi(0, 0, 0, rightObj);

                } else if(translateX > 0){
                    transformUi(translateX, translateY, rightOpacity, rightObj);
                    transformUi(0, 0, 0, leftObj);
                }

                if(useOverlays){
                    leftObj.style.zIndex = 8;
                    rightObj.style.zIndex = 8;
                    topObj.style.zIndex = 7;
                }

            }

        }
        
    };
    
    function gestureEnd(evt) {
        
        if(!touchingElement){
            return;
        }
        
        translateX = currentX - startX;
        translateY = currentY - startY;
        
        timeTaken = new Date().getTime() - startTime;
        
        touchingElement = false;
        
        if(!(currentPosition >= maxElements)){
            if(translateY < (elementHeight * -1) && translateX > ((listElNodesWidth / 2) * -1) && translateX < (listElNodesWidth / 2)){  //is Top?

                if(translateY < (elementHeight * -1) || (Math.abs(translateY) / timeTaken > velocity)){ // Did It Move To Top?
                    onSwipeTop();
                } else {
                    backToMiddle();
                }

            } else {

                if(translateX < 0){
                    if(translateX < ((listElNodesWidth / 2) * -1) || (Math.abs(translateX) / timeTaken > velocity)){ // Did It Move To Left?
                        onSwipeLeft();
                    } else {
                        backToMiddle();
                    }
                } else if(translateX > 0) {
                    
                    if (translateX > (listElNodesWidth / 2) && (Math.abs(translateX) / timeTaken > velocity)){ // Did It Move To Right?
                        onSwipeRight();
                    } else {
                        backToMiddle();
                    }

                }
            }
        }
    };
    
    element.addEventListener('touchstart', gestureStart, false);
    element.addEventListener('touchmove', gestureMove, false);
    element.addEventListener('touchend', gestureEnd, false);
    
    //Add listeners to call global action for swipe cards
    var buttonLeft = document.querySelector('.left-action');
    var buttonTop = document.querySelector('.top-action');
    var buttonRight = document.querySelector('.right-action');

    buttonLeft.addEventListener('click', onActionLeft, false);
    buttonTop.addEventListener('click', onActionTop, false);
    buttonRight.addEventListener('click', onActionRight, false);

}

stackedCards();

});



</script>    
</body>
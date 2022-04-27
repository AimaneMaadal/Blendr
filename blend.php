<?php
include'class/user.php';

session_start();
if(!isset($_SESSION['user']))
{
 header('location:login.php');
}
$user_id=$_SESSION['user'];
$user = new USER();

//fetch user details
$result=$user->user_detail($user_id);

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brandish</title>
    <style>
        /* Stacked Cards component css */
body {
  font-family: "Open Sans";
  font-size: 12px;
  background: #BFC7D0;
}

.no-transition {
  -webkit-transition: none ! important;
  -o-transition: none ! important;
  transition: none ! important;
}

.stackedcards-overflow {
    overflow-y: hidden !important;
}

.stackedcards.init {
    opacity: 0;/* set the opacity to 0 if you want a fade-in effect to stacked cards on page load */
}

.stackedcards {
    position: relative;
    width: 358px;
    margin: 0 auto;
}

.stackedcards * {
    -webkit-user-select: none;
            -moz-user-select: none;
             -ms-user-select: none;
         user-select: none;
}

.stackedcards--animatable {
    -webkit-transition: all 400ms ease;
            -o-transition: all 400ms ease;
            transition: all 400ms ease;
}

.stackedcards .stackedcards-container > *,
.stackedcards-overlay {
    position: absolute;
    width: 100%; /* set 100% */
    height: 300px; /* set 100% */
    will-change: transform, opacity;
    top: 0;
    border-radius: 10px;
}

.stackedcards-overlay.left > div,
.stackedcards-overlay.right > div,
.stackedcards-overlay.top > div {
    width: 100%;
    height: 100%;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
}

.stackedcards-overlay.left,
.stackedcards-overlay.right,
.stackedcards-overlay.top {
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
    left: 0;
    opacity: 0;
    top: 0;
    height: 100%;
    font-size: 24px; /* this style was added only for better preview */
    text-transform: uppercase; /* this style was added only for better preview */
    font-weight: 500; /* this style was added only for better preview */
    color: #fff; /* this style was added only for better preview */
}

.stackedcards-overlay.top {
    background: #E38568;
}

.stackedcards-overlay.right {
    background: #7BB3C5;
}

.stackedcards-overlay.left {
    background: #E58D93;
}

.stackedcards-overlay.left:empty,
.stackedcards-overlay.right:empty,
.stackedcards-overlay.top:empty {
  display: none !important;
}

.stackedcards-overlay-hidden {
    display: none;
}

.stackedcards-origin-bottom {
    -webkit-transform-origin: bottom;
            -ms-transform-origin: bottom;
        transform-origin: bottom;
}

.stackedcards-origin-top {
    -webkit-transform-origin: top;
            -ms-transform-origin: top;
        transform-origin: top;
}

.stackedcards-bottom,
.stackedcards-top,
.stackedcards-none {
    background: #fff; /* set card background background */
    height: 100%;
}

.stackedcards .stackedcards-container > :nth-child(1) {
    position: relative;
    display: block;
}

/* global actions buttons*/
.global-actions {
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    width: 100%;
    margin-top: 10px;
}

.top-action,
.right-action,
.left-action {
    width: 100%;
    height: 50px;
    border-radius: 10px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
    text-transform: uppercase;
    font-weight: 500;
    color: #fff;
}

.top-action {
    background: #E38568;
    margin: 0 10px; 
}

.right-action { background: #7BB3C5; }
.left-action { background: #E58D93; }

/* elements on stacked cards */
.card-item { background: #FFFFFF; }


    </style>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="container">
<div class="header">
		<a href="Logout.php">Logout</a>
		<a href="">Hi <?php echo($result['username']); ?></a>
	</div>

    <div id="stacked-cards-block" class="stackedcards stackedcards--animatable init">
  <div class="stackedcards-container">
    <div class="card-item">ok</div>
    <div class="card-item">ok</div>
    <div class="card-item"></div>
    <div class="card-item"></div>
    <div class="card-item"></div>
    <div class="card-item"></div>
    <div class="card-item"></div>
  </div>
  <div class="stackedcards--animatable stackedcards-overlay top">TOP</div>
  <div class="stackedcards--animatable stackedcards-overlay right">RIGHT</div>
  <div class="stackedcards--animatable stackedcards-overlay left">LEFT</div>
</div>
<div class="global-actions">
  <div class="left-action">Left</div>
  <div class="top-action">Top</div>
  <div class="right-action">Right</div>
</div>

<div class="bottomNav">
		<a href="index.php"><img src="images/icons/home.svg" style="width: 8%;"></a>
		<a href="recepten.php"><img src="images/icons/recepten.svg" style="width: 6%;"></a>
		<a href="blend.php"><img src="images/icons/blend.svg" style="width: 9%;"></a>
		<a href="chat.php"><img src="images/icons/chat_active.svg" style="width: 9%;"></a>
	<div>

</div>
<script>


    // JavaScript Document
document.addEventListener("DOMContentLoaded", function(event) {

function stackedCards () {

    var stackedOptions = 'Top'; //Change stacked cards view from 'Bottom', 'Top' or 'None'.
    var rotate = true; //Activate the elements' rotation for each move on stacked cards.
    var items = 3; //Number of visible elements when the stacked options are bottom or top.
    var elementsMargin = 10; //Define the distance of each element when the stacked options are bottom or top.
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
        <?php echo "yooooooooooooooo" ?>
    };
    
    //Swipe active card to right.
    function onSwipeRight() {
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

</html>
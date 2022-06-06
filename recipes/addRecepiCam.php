<?php

session_start();



?><!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camera</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
	<script src="https://kit.fontawesome.com/6ec6696b28.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="feed.css">
    <link rel="stylesheet" href="../style.css">
	
    <style>
    #my_camera{
        width: 320px;
        height: 240px;
		border-radius: 10px;
    }
	#results{
        width: 320px;
        height: 240px;
		margin-top: 57px;
		border-radius: 10px;
    }
	#my_camera video{
		border-radius: 10px;
    }

	.fileChoice{
		display: flex;
		justify-content: space-around;
		margin-top: 156px;
		width: 80%;
	}
	.fileChoice a:first-child{
		font-weight: 600px;
	}
	.activeChoice{
		border-bottom: 3px solid #FF7A00;
		height: 15px;
		width: 160px;
		text-align: center;
		margin-left: 145px
	}
	.retake{
		padding: 5px 22px;
		position: absolute;
		bottom: 389px;
		display: block;
		background-color: #FF7A00;
		border: none;
		border-radius: 10px;
		color: white;
		font-weight: 700;
	}
	</style>
</head>
<body onload="configure()">

<div class="wrapper">
<div class="topHeader">
        <div><i class="fa-solid fa-chevron-left fa-lg">&nbsp&nbsp&nbsp&nbsp&nbsp</i><b>Camera</b> </div>
        <div><label><i class="fa-solid fa-arrow-right fa-lg" style="color: #F0A500;"></i><input type=button value="Save Snapshot" onClick="saveSnap()" style="display: none;"></label></div>
    </div>  
	
	<div id="results">
		
	</div>	
	<input type=button value="Opnieuw" onClick="configure()" class="retake">
	<label><img style="margin-top: 100px;" src="../php/icons/camera.svg"><input style="display: none;" type=button value="Take Snapshot" onClick="take_snapshot()"></label>
	
	<div class="fileChoice">
            <a href="addRecepiGal.php">Galery</a>
            <a href="addRecepiCam.php" style="font-weight: 700;color: #FF7A00;">Camera</a>
    </div>
	<div class="activeChoice"></div>

  
</div>
	
	<!-- Script -->

	<!-- Code to handle taking the snapshot and displaying it locally -->
	<script language="JavaScript">
		
		// Configure a few settings and attach camera
		function configure(){
			$(".retake").css("display", "none");
			$('#results').find('#imageprev').remove();
			$('#results').append('<div id="my_camera">hello</div>'); 
			Webcam.set({
				width: 320,
				height: 240,
				image_format: 'jpeg',
				jpeg_quality: 90,
				border_radius: 10
			});
			Webcam.attach( '#my_camera' );

		}
		// A button for taking snaps
		

		// preload shutter audio clip

		function take_snapshot() {
			// play sound effect
			// take snapshot and get image data
			$(".retake").css("display", "block");
			Webcam.snap( function(data_uri) {
				// display results in page
				document.getElementById('results').innerHTML = 
					'<img id="imageprev" style="border-radius: 10px;" src="'+data_uri+'"/>';
			} );

			Webcam.reset();
		}

		function saveSnap(){
			// Get base64 value from <img id='imageprev'> source
			var base64image =  document.getElementById("imageprev").src;

			 Webcam.upload( base64image, 'ajax/camera_image.php', function(code, text) {
				 console.log('Save successfully');
				 console.log(text);
				 window.location.href = "addRecepi.php?recepiId=" + text;
            });


		}
	</script>
	
</body>
</html>

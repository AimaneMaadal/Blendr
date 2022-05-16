<?php

session_start();



?><!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to capture picture from webcam with Webcam.js</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="feed.css">
    <link rel="stylesheet" href="../style.css">
	

</head>
<body onload="configure()">

	<!-- CSS -->
    <style>
    #my_camera{
        width: 320px;
        height: 240px;
        border: 1px solid black;
		border-radius: 10px;
    }
	#results{
        width: 320px;
        height: 240px;
        border: 1px solid black;
		margin-top: 150px;
		border-radius: 10px;
    }
	#my_camera video{
		border-radius: 10px;
    }
	</style>

	<!-- -->
<div class="wrapper">
	<div id="results">
		
	</div>	
	<input type=button value="Configure" onClick="configure()" class="retake">
	<label><img src="../php/icons/camera.svg"><input style="display: none;" type=button value="Take Snapshot" onClick="take_snapshot()"></label>
	<input type=button value="Save Snapshot" onClick="saveSnap()">
	<div class="fileChoice">
            <a href="addPost.php" style="font-weight: 700;color: #FF7A00;">Galery</a>
            <a href="addPostCam.php">Camera</a>
        </div>
  
</div>
	
	<!-- Script -->
	<script type="text/javascript" src="../vendor/webcamjs/webcam.min.js"></script>

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
					'<img id="imageprev" src="'+data_uri+'"/>';
			} );

			Webcam.reset();
		}

		function saveSnap(){
			// Get base64 value from <img id='imageprev'> source
			var base64image =  document.getElementById("imageprev").src;

			 Webcam.upload( base64image, 'ajax/camera_image.php', function(code, text) {
				 console.log('Save successfully');
				 console.log(text);
            });

		}
	</script>
	
</body>
</html>

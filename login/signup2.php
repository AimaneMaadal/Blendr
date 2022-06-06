<?php

session_start();

$tags = array (
    array("Sports","football","basketball","tennis","baseball","golf","running","volleyball","badminton","swimming","boxing","table tennis","skiing","ice skating","roller skating","cricket","rugby","pool","darts","football","bowling","ice hockey","surfing","karate","horse racing","snowboarding","skateboarding","cycling","archery","fishing","gymnastics","figure skating","rock climbing","sumo wrestling","taekwondo","fencing","water skiing","jet skiing","fitness"),
    array("Career","agriculture","construction","education","bussiness","management","finance","art","audio/video","communication","politic","health care","tourism","social work","transport","marketing","science","sales","security","manufacturing","law","traffic","law enforcement","military","volunteer","cleaning","","","","","","","","","","","","",""),
    array("Culture","christianity","islam","hinduism","buddhism","folk Religions","judaism","atheist","","","","","","","","","","","","","","","","","","","","","","","","","","","","","",""),
    array("Hobbies","reading","traveling","fishing","crafting","tv","bird watching","collecting","music","gardening","video games","cooking","cars","board games","","","","","","","","","","","","","","","","","","","","","","","",""),
    array("Goals","world travel","languages","volunteer","weight loss","marathon","adventure","new sport","try extreme sport","make a difference in the world","mentor","","","","","","","","","","","","","","","","","","","","","","","","","","","")
);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creative Minds</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>

.inputFields {
    width: 80%;
    margin: 30px auto;
}

.inputField1 {
    width: 100%;
    padding: 10px 25px;
    border: 4px solid #0600FE;
}

.inputField2 {
    width: 100%;
    padding: 10px 25px;
    height: 300px;
    border: 4px solid #0600FE;
    margin-top: 20px;
}

.tagField input{
    padding: 10px 20px;
    width: 80%;
    font-weight: 600;
    float: left;
    border-radius: 5px 0px 0px 5px;
    border: none;
    background-color: #ECECEC;
}
.tagField input:focus{
    outline: none;
}

.tagField {
    float: left;
    display: flex;
    width: 100%;
}

.tagsInput {
    width: 100%;
    padding: 10px 25px;
    border: 4px solid #0600FE;
    margin-top: 0px;
}


.add_button {
    background-color: white;
    color: #001F3C;
    text-decoration: none;
    font-size: 16px;
    background-color: #ECECEC;
    text-align: center; 
    font-weight: bolder;
    width: 20%;
    display: block;
    float: left;
    height: 40px;
    line-height: 40px;
    border-radius: 0px 5px 5px 0px;
}

.remove_button {
    background-color: #0600FE;
    color: white;
    text-decoration: none;
    font-size: 40px;
    text-align: center;
    font-family: "blaak";
    font-weight: bolder;
    width: 51px;
    height: 51px;
    float: right;
}

.postButton {
    background-color: #D8000C;
    margin-top: 40px;
    text-decoration: none;
    background-color: rgb(255, 255, 255);
    padding: 18px 55px;
    font-family: 'roboto';
    font-size: 100%;
    width: 50%;
    color: black;
    display: block;
    margin: 100px auto;
    color: #0600FE;
    background-color: #C0FD00;
    border: none;
}
form {
    width: 100%;
    height: 80%;
}
#uploadImage{
    padding: 2px 7% 2px;
    border-radius: 50px;
    color: #001F3B;
    font-weight: bolder;
    border: 1px solid grey;
}
.active{
    background-color: #FF7A00;
    color: white !important;
    border: 1px solid #FF7A00 !important;
}
.topTags{
    margin: 60px 0px 50px;
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    gap: 7px;
}
.categories{
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    gap: 9px;
    margin-bottom: 30px;
    margin-top: 20px;
}
.uploadTags {
    height: 45px;
    width: 300px;
    border: none;
    color: #fff;
    font-size: 17px;
    background: #FF7A00;
    border-radius: 15px;
    cursor: pointer;
    font-weight: 600;
    position: sticky;
    bottom: 20px;
}
    </style>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

  
    <?php if (!empty($error)) {
    echo $error;
} ?>
<div class="wrapper">
<h1 style="align-self: start;margin: 30px 0px 0px 45px;">Sign up</h1>
    <img src="../php/icons/step2.svg" style="width: 80%;margin: 20px 0px 20px -15px;">
    <p style="width: 80%;">Complete your profile by adding tags that describe you as a person and tell a bit more about your identity. Choose from the tags below or add your own tags. </p>   
    <form action="" method="POST" enctype="multipart/form-data">
            <div class="inputFields">
                <br>
                    <div class="field_wrapper">
                        <div class="tagField">
                            <input type="text"  placeholder="voeg je eigen tag toe" name="tags[]"  id="tagsInput" value=""/>
                            <br><a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                        </div>
                    </div>
            
          
            <div class="topTags"></div>
     </form>
     <?php
        for ($row = 0; $row < 5; $row++) {
            echo "<h2>".$tags[$row][0]."</h2>";
            echo "<div class='categories'>";
        for ($col = 1; $col < 38; $col++) {
            if($tags[$row][$col]){echo '<input type="button" data-id="'.$tags[$row][$col].'" id="uploadImage" value="'.$tags[$row][$col].'" class="image1"></input>';}
        }
        echo "</div>";
        }
        
    ?>   
     <br><input type="button" href="javascript:void(0);" value="volgende" class="uploadTags" title="Add field"/>
</div>
        


    <script>
        //onclick of button id refresh page

        $(document).ready(function(){
            var maxField = 11; 
            var addButton = $('.add_button');
            var uploadButton = $('.uploadTags');
            var wrapper = $('.field_wrapper'); 
            var top = $('.topTags'); 
            var fieldHTML = '<div class="tagField"><input type="text" name="tags[]" class="clicker" value="" /></div>';
            var x = 1; 
            var z = [];

            
            $(addButton).click(function(){
                
                if(x < maxField){ 
                    var input = $( ".field_wrapper div input" ).val();
                    if(input != "" && !z.includes(input)){    
                        $( ".field_wrapper div input" ).val("");
                        var newTag = '<input type="button" data-id="'+input+'" id="uploadImage" class="active" value="'+input+'"  class="image1"></input>'
                        x++;
                        $(top).append(newTag); 
                        z.push(input);
                        console.log(z);
                    }
                }
            });
            
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); 
                x--;
            });
            $(document).on("click","#uploadImage",function(){
                if (z.includes($(this).data('id'))) {
                    z.splice( $.inArray($(this).data('id'), z), 1 );
                    $(this).removeClass('active');
                }
                else{
                    $(this).addClass("active");
                    z.push($(this).data('id'));
                }
                console.log(z);
            });
            $(document).on('click', '.uploadTags', function(e){
                if (z == "") {
                    alert("nope");  
                }
                else{
                    const myJSON = JSON.stringify(z);
                    alert(myJSON);
                    $.ajax({
                        url: "ajax/add_tags.php",
                        type: "POST",
                        data: {tags: myJSON},
                        success: function(data){
                            console.log(data);
                            window.location.href = "signup3.php";
                        }
                    });
                    alert(z);
                }
            });

        });

      
        
</script>
        





</body>

</html>
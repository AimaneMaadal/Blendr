<?php

session_start();








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
    background-color: orange;
    color: white !important;
    border: 1px solid orange !important;
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
    gap: 7px;
    margin-bottom: 20px;
}
.uploadTags {
    height: 45px;
    width: 300px;
    display: block;
    border: none;
    color: #fff;
    font-size: 17px;
    background: #FF7A00;
    border-radius: 15px;
    cursor: pointer;
    margin-top: 13px;
    font-weight: 600;
    position: fixed;
    top: 815px;
    margin: 0 auto;
}
    </style>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

  
    <?php if (!empty($error)) {
    echo $error;
} ?>
<div class="wrapper">
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
     <h2>Origine</h2>
     <div class="categories">
        <input type="button" data-id="Indisch" id="uploadImage" value="Indisch" class="image1"></input>
        <input type="button" data-id="Amerikaans" id="uploadImage" value="Amerikaans" class="image1"></input>
        <input type="button" data-id="Zweeds" id="uploadImage" value="Zweeds" class="image1"></input>
        <input type="button" data-id="Europees" id="uploadImage" value="Europees" class="image1"></input>
        <input type="button" data-id="Noord-afrikaans" id="uploadImage" value="Noord-afrikaans" class="image1"></input>
        <input type="button" data-id="Chinees" id="uploadImage" value="Chinees" class="image1"></input>
     </div>
     <h2>Land</h2>
     <div class="categories">
        <input type="button" data-id="China" id="uploadImage" value="China" class="image1"></input>
        <input type="button" data-id="Zweden" id="uploadImage" value="Zweden" class="image1"></input>
        <input type="button" data-id="Belgie" id="uploadImage" value="Belgie" class="image1"></input>
        <input type="button" data-id="Congo" id="uploadImage" value="Congo" class="image1"></input>
     </div>
     <h2>Tijd</h2>
     <div class="categories">
        <input type="button" data-id="Middag" id="uploadImage" value="Middag" class="image1"></input>
        <input type="button" data-id="Voormiddag" id="uploadImage" value="Voormiddag" class="image1"></input>
        <input type="button" data-id="S'ochtend" id="uploadImage" value="S'ochtend" class="image1"></input>
        <input type="button" data-id="S'avonds" id="uploadImage" value="S'avonds" class="image1"></input>
     </div>

     
     <br><input type="button" href="javascript:void(0);" value="volgende" class="uploadTags" title="Add field"/>
</div>
        


    <script>
        //onclick of button id refresh page

        $(document).ready(function(){
            var maxField = 6; 
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
                        data: {
                            tags: myJSON,
                            id : <?php echo $_GET["id"]; ?>    
                        },
                        success: function(data){
                            console.log(data);
                            window.location.href = "addRecepi.php?recepiId=<?php echo $_GET["id"]; ?>";
                        }
                    });
                    alert(z);
                }
            });

        });

      
        
</script>
        





</body>

</html>
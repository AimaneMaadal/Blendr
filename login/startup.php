<?php 
  session_start();
  if (isset($_SESSION["unique_id"])) {
    header('Location: ../feed/index.php');
  }

?>

<?php include_once "header.php"; ?>
<head>
    <style>
        .intro_text{
            font-size: 20px;
            font-weight: bold;
            color: #001F3B;
            margin-top: 20px;
            margin-bottom: 10px;
        
        }
        .intro_info{
            font-size: 14px;
            margin-bottom: 100px;
        }
        .intro_img{
        display: flex;
        align-items: center;
        overflow: hidden;
       

        }
        .intro_img img{
            width: 100%;
            height: auto;
          
        }
      
        .intro_dots{
            display: flex;
            justify-content: baseline;
            align-items: center;
       
        }
        .intro_dots .dot{
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #C4C4C4;
            margin-right: 10px;
            transition: 0.3s;
        }
        .active{
            border: 6px solid #FF7A00;
            transition: 0.3s;
        }
        .intro_under{
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }
        .intro_next{
            font-family: 'Source Sans Pro';
            font-weight: bold;
            color: #FF7A00;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <script>
        let intro_slide = 1;
        
        function nextSlide(){
        
            let dots = document.querySelectorAll('.intro_dots .dot');
            let images = document.querySelectorAll('.intro_img img');
            if (intro_slide < 3) {
                if(intro_slide==1){
                    document.querySelector(".intro_text").innerHTML = "Meet people in your neighborhood by sharing <span style='color: #FF7A00'>dishes</span>  and  <span style='color: #F1A500'>experiences</span>";
                    document.querySelector(".intro_info").innerHTML = "Match with people in your area and share stories, recepis and friendship. Get out of your comfortzone and discover new things.";
                    images[0].style.order = "2";
                    images[1].style.order = "1";
                    images[2].style.order = "0";
            
                    dots.forEach(dot => {
                        dot.classList.remove('active');
                    });
                    dots[1].classList.add('active');
                }
                else if(intro_slide==2){
                    document.querySelector(".intro_text").innerHTML = "View, post and share your favorite <span style='color: #FF7A00'>recipes</span>  with all necessary  <span style='color: #F1A500'>ingredients</span>";
                    document.querySelector(".intro_info").innerHTML = "On the app you can consult all the recipes provided by users or by the app. In addition you can see the ingredients that the recipe requires and consult our partner supermarket.";
                    images[0].style.order = "1";
                    images[1].style.order = "0";
                    images[2].style.order = "2";

                    dots.forEach(dot => {
                        dot.classList.remove('active');
                    });
               
                    dots[2].classList.add('active');
                }
                else{
                    window.location.href = "./signup.php";
                }
                intro_slide++;
               
            }
            else{
                    window.location.href = "./signup.php";
                }
        }
    </script>
  <div class="wrapper">
        <section class="form"><div class="intro_text">Meet people with different<span style='color: #FF7A00'> food culture</span> but with the same  <span style='color: #F1A500'>interests</span></div>
        <div class="intro_info">On the app u can match with people based on your differnces of food and culture, but also find people with the same life intrest and meet for the food and stay for the friendship!</div>
        <div class="intro_img"><img src="../php/images/intro/1.png"><img src="../php/images/intro/2.png"><img src="../php/images/intro/3.png"></div>
        <div class="intro_under">
        <div class="intro_dots">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
        <div class="intro_next" onclick="nextSlide()">Next</div></section>
        </div>
  </div>
</body>
</html>

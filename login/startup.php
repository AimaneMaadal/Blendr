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
                    document.querySelector(".intro_text").innerHTML = "Ontmoet mensen in je buurt door <span style='color: #FF7A00'>gerechten</span> en <span style='color: #F1A500'>verhalen</span> te delen";
                  
                    images[0].style.order = "2";
                    images[1].style.order = "1";
                    images[2].style.order = "0";
            
                    dots.forEach(dot => {
                        dot.classList.remove('active');
                    });
               
                    dots[1].classList.add('active');
                }
                else if(intro_slide==2){
                    document.querySelector(".intro_text").innerHTML = "Bekijk, plaats en deel je favoriete <span style='color: #FF7A00'>recepten</span> met alle nodige <span style='color: #F1A500'>ingredieënten</span>";
                    document.querySelector(".intro_info").innerHTML = "Op de app kan je allerij recepten raadplegen die door gebruikers of door de app word voorzien. Daarnaast kan je de ingredienten zien die de recept nodig en die bij onze partner supermarkt raadplegen";
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
        <section class="form"><div class="intro_text">Ontmoet mensen met een andere <span style="color: #F1A500">eetcultuur</span> maar met dezelfde <span style="color: #FF7A00">intresses</span></div>
        <div class="intro_info">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus assumenda maiores quidem soluta nesciunt porro obcaecati sapiente quam qui. Optio architecto totam nemo voluptatem cupiditate perferendis distinctio fugiat libero a?</div>
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

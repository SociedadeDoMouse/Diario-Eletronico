<html>
    <head>
        <style>
body, html {
    height: 100%;
    text-align: center;
    overflow: hidden;
}

body {
  background-color: #242F3F;
}

@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

:root {
  --cube-bg: #9b9b9b;
  --cube-bg-hover1: #0792bd;
  --cube-bg-hover2: #3b9bb8;
  --cube-bg-hover3: #00b1e7;
}


  .container {
  display: inline-block;
  position: relative;
  top: 30%; 
}


  .loader{
    animation: jump infinite 2s ease-out;
  }
  .text-container {
    margin: 2rem 0;
    font-weight: 700;
    color: #fff;
  }

  span{
      display: inline-block;
      margin-right: 0.5rem;
      animation: jump infinite 1.5s ease-out;
  }
      span:nth-child(2),
      span:nth-child(3) {
        animation-delay: 0.1s;
      }
      span:nth-child(4),
      span:nth-child(5){
        animation-delay: 0.2s;
      }
      span:nth-child(6),
      span:nth-child(7) {
        animation-delay: 0.3s;
      }
      span:nth-child(8), 
      span:nth-child(9) {
        animation-delay: 0.4s;
      }
      span:nth-child(10),
      span:nth-child(11){
        animation-delay: 0.5s;
      }
      span:last-of-type {
        margin: 0;
      }
    

@keyframes jump {
  0% {
    transform: translateY(0);
  }
  
  50% {
    transform: translateY(1rem);
  }
  
  100% {
    transform: translateY(0);
  }
}


        </style>
    </head>
    <body>



        <div class="container">
         <div class="loader"> <img src="/build/img/logo_gray.svg" width="140px"></div>
            <div class="text-container">
              <span>L</span>
              <span>o</span>
              <span>a</span>
              <span>d</span>
              <span>i</span>
              <span>n</span>
              <span>g</span>
              <span>.</span>
              <span>.</span>
              <span>.</span>
            </div>
        </div>


        <script>
             window.location = '<?php
             echo $_GET['rel'].".php?";
              if (isset($_POST['turma']) && $_POST['ano']) {
                 echo 'turma='.$_POST['turma'].'&ano='.$_POST['ano'];
             } else if (isset($_POST['min'])) {
                 echo 'min='.$_POST['min'];
             } 
            ?>'
        </script>
        </body>
</html>
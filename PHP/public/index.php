<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="/assets/img/icon.png" size=“16x16" >
    <title>VirtuArte</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css"> -->
    <!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css"> -->

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/commom.css">
    <link rel="stylesheet" href="/assets/css/user/chatbot.css">
  </head>
  <body>
    <?php if(!isset($_SESSION['usersId'])): ?>
    <header>
      <nav class="navbar navbar-expand-md navbar-toggleable-sm navbar-light bg-white border-bottom box-shadow">
        <!-- class fixed-top -->
        <div class="container justify-content-between">
          <a class="navbar-brand" href="/home">
            <img class="logo" src="/assets/img/logo.png" alt="Logo VirtuArte">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end" id="offcanvasNavbar">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body navbar-collapse collapse d-grid align-content-center justify-content-center justify-items-center">
              <ul class="navbar-nav flex-grow-1 mb-2 mt-2">
                <li class="nav-item">
                  <a href="/home" class="nav-link text-dark">Home</a>
                </li>
                <li class="nav-item">
                  <a href="/home#about" class="nav-link text-dark">Sobre</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark" data-bs-toggle="modal" data-bs-target="#staticBackdropContact" id="contact">Contato</a>
                </li>
              </ul>
              <div class="button d-flex justify-content-end mb-2 mt-2">
                <button class="bg-purple" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropLogin">
                  <a href="/user/login" class="text-white nav-link">Entrar</a>
                </button>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <?php else: ?>
      <link rel="stylesheet" href="/assets/css/user/feed.css">
      <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
      
      <?php $nivelChat = 0 ?>

      <?php 
        //if($_SERVER['REQUEST_URI'] == '/user/feed'){
      ?>
      <div class="accordion chatbot border-acordion" id="chatbot">
        <div class="accordion-item border-acordion">
          <div class="accordion-header" id="headingOne">
            <!-- <button class="accordion-button border-acordion" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"> -->
            <button class="accordion-button border-acordion collapsed" id="chat-mobile-button" type="button" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
              Converse com o Vitu
            </button>
          </div>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="wrapper">
              <div class="form">
                <div class="chat">
                  <div class="bot-inbox inbox">
                    <div class="icon">
                      <img src="/assets/img/vitu-chat.png" alt="">
                    </div>
                    <div class="msg-header">
                      <p class="text-break">Olá, eu sou o Vitu!</p>
                      <input type="hidden" id="nivel" value="<?= $nivelChat ?>">
                    </div>
                  </div>
                </div>
              </div>
              <div class="typing-field">
                <div class="input-data">
                  <input id="data" type="text" placeholder="Escreva aqui..." required>
                  <button id="send-btn">Enviar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
       // }
      ?>
    <?php endif; ?>   

    <?php
      include_once '../Application/helpers/session_helper.php';
      require '../Application/autoload.php';

      use Application\core\App;
      use Application\core\Controller;

      $app = new App();

    ?>


  <?php if(!isset($_SESSION['usersId'])): ?>
    <!-- Modal Contact -->
<div class="modal fade modal-contact" id="staticBackdropContact" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-purple">
      <div class="modal-body p-0 row">
        <div class="col-5 d-flex align-items-center justify-content-center">
          <div class="container ms-5 me-5">
            <h4 class="fs-3"><strong>Entre em contato conosco</strong></h4>
            <p class="contact-instruction mb-5 fs-5">Preencha o formulário ou procure por um destes meios</p>
            <div class="mt-5 fs-6">
              <div class="d-flex py-2">
                <i class="glyphicon glyphicon-envelope fs-5 top-0"></i>
                <p class="px-3">contato.virtuarte@gmail.com</p>
              </div>
              <div class="d-flex py-2">
                <i class="glyphicon glyphicon-map-marker fs-5 top-0"></i>
                <p class="px-3">R. Pedro Vicente, 625 - Canindé, São Paulo - SP, 01109-010</p>
              </div>
              <div class="d-flex py-2">
                <i class="glyphicon glyphicon-earphone fs-5 top-0"></i>
                <p class="px-3">(11) 9999-9999</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-7 p-0 position-relative right-config bg-white background-span">
          <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="container d-flex align-items-center justify-content-center m-auto h-100">
            <form action="https://formspree.io/f/xayarpql" method="post" class="w-100 px-4 pt-4">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingContactName" name="floatingContactName" placeholder="Berga Motta" required>
                <label for="floatingContactName">Nome</label>
              </div>
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingContactEmail" name="floatingContactEmail" placeholder="name@example" required>
                <label for="floatingContactEmail">E-mail</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingContactTopic" name="floatingContactTopic" placeholder="Interação com o Vitu">
                <label for="floatingContactTopic">Assunto</label>
              </div>
              <div class="form-floating">
                <textarea class="form-control h-textarea" id="floatingContactMessage" name="floatingContactMessage" placeholder="Descreva sua mensagem" required></textarea>
                <label for="floatingContactMessage">Mensagem</label>
              </div>
              <div class="button d-flex justify-content-center mt-4">
                <button class="bg-blue btn btn-form" type="submit">Enviar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <footer class="border-top footer mt-5 pt-4 pb-4 bg-purple">
    <div class="container">
      <div>
        <img src="/assets/img/logo branca.png" alt="Logo VirtuArte">
      </div>
      <hr>
      <div class="d-flex justify-content-between mt-4">
        <div>
          <ul class="navbar-nav flex-row list-style-disc nav-footer">
            <li class="nav-item ms-3 me-3">
              <a href="/home#about" class="nav-link">Sobre</a>
            </li>
            <li class="nav-item ms-3 me-3">
              <a class="nav-link" data-bs-toggle="modal" data-bs-target="#staticBackdropContact">Contato</a>
            </li>
            <li class="nav-item ms-3 me-3">
              <a href="#" class="nav-link">Termos de Uso</a>
            </li>
            <li class="nav-item ms-3 me-3">
              <a href="#" class="nav-link">Políticas de Privacidade</a>
            </li>
          </ul>
        </div>
        <span class="me-3">
          &copy; 2021 - VirtuArte
        </span>
      </div>
    </div>
  </footer>
  <?php endif; ?> 
    <script src="~/lib/jquery/dist/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->


    <script src="/assets/js/jquery.slim.min.js"></script>
    <!-- <script src="/assets/js/bootstrap.min.js"></script> -->

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- <script src="/assets/js/user/chatbot.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="/assets/js/user/feed.js"></script>
    
    <script>
      function sizeChatbot(){
        var chatButton = document.getElementById('chat-mobile-button');
        console.log('resize');
        if(window.innerWidth > 768){
          chatButton.setAttribute('data-bs-toggle', '');
          document.getElementById('collapseOne').classList.add('show');
          if(document.getElementById('feed')){
            document.getElementById('feed').classList.add('mx-5');
          }
        }
        else if(window.innerWidth <= 768){
          chatButton.setAttribute('data-bs-toggle', 'collapse');
          document.getElementById('collapseOne').classList.remove('show');
          if(document.getElementById('feed')){
            document.getElementById('feed').classList.remove('mx-5');
          }
        }
      };
      sizeChatbot();

      window.addEventListener('resize', function(){
        sizeChatbot();
      });
        

      $(document).ready(function(){
        $nivel = $("#nivel").val();
          $estado       = '';
          $cidade       = '';
          $preferencia  = '';
        $("#send-btn").on("click", function(){
          $value = $("#data").val();
          $msg = '<div class="user-inbox inbox"><div class="msg-header"><p class="text-break">'+ $value +'</p></div></div>';
          $(".form").append($msg);
          $("#data").val('');

          $nivel++;
          $("#nivel").val($nivel);

          // console.log($nivel)

          if($value != "oi" && $value != "ola" && $value != "olá" && $value != "oie" && $value != "oii" && $value != "ooi" && $value != "hello" && $value != "hi" && $value != "hey" && $value != "coé" && $value != "iai" && $value != "eai"){
            if($nivel == 2){
              $estado = $value;
            }
            if($nivel == 3){
              $cidade = $value;
            }
            if($nivel == 4){
              $preferencia = $value;
            }
          }
          
          // start ajax code
          $.ajax({
            url: '../../message.php',
            type: 'POST',
            // data: 'text='+$value,
            data: {text: $value, nivel: $nivel, estado: $estado, cidade: $cidade, preferencia: $preferencia},
            success: function(result){
              $default = `<div class=inbox bot-inbox><div class=icon><img src=/assets/img/vitu-chat.png></div><div class=msg-header><p class=text-break>Que estado você pretende visitar?</p></div></div>`;
              if($value == "oi" || $value == "ola" || $value == "oie" || $value == "oii" || $value == "ooi" || $value == "hello" || $value == "hi" || $value == "hey" || $value == "coé" || $value == "iai" || $value == "eai"){
                // $nivel--;
                // $("#nivel").val($nivel);

                $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">Olá</p></div></div>';
                $(".form").append($replay);
                // when chat goes down the scroll bar automatically comes to the bottom
                $(".form").scrollTop($(".form")[0].scrollHeight);
              }
              if(result == "Desculpe, não consegui te entender" || result == "Desculpe, não encontrei informações relacionadas" || result == "Hmm, acho que não entendi"){
                $nivel--;
                $("#nivel").val($nivel);

                $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ result +'. Tente responder novamente ou digite "sair" para recomeçar.</p></div></div>';
                $(".form").append($replay);
                // when chat goes down the scroll bar automatically comes to the bottom
                $(".form").scrollTop($(".form")[0].scrollHeight);
              }
              else if(result == "Desculpe, não tenho nenhuma sugestão para esse local"){
                $nivel = 1;
                $("#nivel").val($nivel);

                $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ result +'. Vamos tentar novamente</p></div></div>';
                $(".form").append($replay);
                $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ 'Que estado você pretende visitar?' +'</p></div></div>';
                $(".form").append($replay);
                // when chat goes down the scroll bar automatically comes to the bottom
                $(".form").scrollTop($(".form")[0].scrollHeight);
              }
              else if (result == "Foi um prazer te ajudar =D"){
                $estado       = '';
                $cidade       = '';
                $preferencia  = '';
                $nivel = 1;
                $("#nivel").val($nivel);
                $replay = '<div class="bot-inbox inbox" id=default><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ result +'</p></div></div>';
                $(".form").append($replay);
                // $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ '<a href="#" class="text-white" onclick="window.location.reload()">Recomeçar</a>' +'</p></div></div>';
                // $default = `<div class=inbox bot-inbox><div class=icon><img src=/assets/img/vitu-chat.png></div><div class=msg-header><p class=text-break>Que estado você pretende visitar?</p></div></div>`;
                // $default = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ 'Que estado você pretende visitar?' +'</p></div></div>';
                $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ `<a href="#" class="text-white" id="restart2" onclick="$('.form').html('${$default}')">Recomeçar</a>` +'</p></div></div>';
                $(".form").append($replay);
                // when chat goes down the scroll bar automatically comes to the bottom
                $(".form").scrollTop($(".form")[0].scrollHeight);
              }
              else if (result == "Recomeçando"){
                $estado       = '';
                $cidade       = '';
                $preferencia  = '';
                $nivel = 1;
                $("#nivel").val($nivel);
                // $replay = '<div class="bot-inbox inbox" id=default><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ result +'</p></div></div>';
                // $(".form").append($replay);
                // $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ '<a href="#" class="text-white" onclick="window.location.reload()">Recomeçar</a>' +'</p></div></div>';
                // $default = `<div class=inbox bot-inbox><div class=icon><img src=/assets/img/vitu-chat.png></div><div class=msg-header><p class=text-break>Que estado você pretende visitar?</p></div></div>`;
                // $default = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ 'Que estado você pretende visitar?' +'</p></div></div>';
                $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ `<a href="#" class="text-white" id="restart2" onclick="$('.form').html('${$default}')">Recomeçar</a>` +'</p></div></div>';
                $(".form").append($replay);
                // when chat goes down the scroll bar automatically comes to the bottom
                $(".form").scrollTop($(".form")[0].scrollHeight);
              }
              else{
                $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header">'+ result +'</div></div>';
                $(".form").append($replay);
                // when chat goes down the scroll bar automatically comes to the bottom
                $(".form").scrollTop($(".form")[0].scrollHeight);
              }
            }
          });
        });
      });
    </script>

  </body>
</html>

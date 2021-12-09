<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
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
                  <a class="nav-link text-dark" data-bs-toggle="modal" data-bs-target="#staticBackdropContact">Contato</a>
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
      <header>
        <nav class="navbar navbar-expand-md navbar-toggleable-sm navbar-light bg-white border-bottom box-shadow mb-3 fixed-top">
          <div class="container justify-content-between">
            <a class="navbar-brand" href="/">
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
              <div class="search offcanvas-body navbar-collapse collapse d-grid align-content-center justify-content-center justify-items-center">
                <input type="search" id="bar-search" name="bar-search" placeholder="Buscar no VirtuArte">
              </div>
            </div>
            <div class="nav-right d-flex align-items-center">
              <img src="/assets/img/foto-luna-nav.png" alt="Foto Luna Maria">
              <div class="dropdown little-menu">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  <?php 
                    $name = explode(" ", $_SESSION['usersName']);
                    $firstName = $name[0];
                    $lastName = sizeof($name) > 1 ? $name[sizeof($name) - 1] : ''
                   ?>
                  <?= $name[0] ?>
                  <?= sizeof($name) > 1 ? $name[sizeof($name) - 1] : '' ?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item" href="/user/profile/<?= (int)$_SESSION['usersId'] ?>">Abrir perfil</a></li>
                  <li><a class="dropdown-item text-danger" href="/user/logout">Sair</a></li>
                </ul>
              </div>
            </div>
          </div>
        </nav>
      </header>
      <?php $nivelChat = 0 ?>

      <?php 
        if($_SERVER['REQUEST_URI'] == '/user/feed'){
      ?>
      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <div class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
              Converse com o Vitu
            </button>
          </div>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="wrapper">
              <div class="form">
                <div class="bot-inbox inbox">
                  <div class="icon">
                    <img src="/assets/img/vitu-chat.png" alt="">
                  </div>
                  <div class="msg-header">
                    <p class="text-break">Olá, eu sou o Vitu! Em que posso te ajudar?</p>
                    <input type="hidden" id="nivel" value="<?= $nivelChat ?>">
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
        }
      ?>
    <?php endif; ?>   

    <?php
      include_once '../Application/helpers/session_helper.php';
      require '../Application/autoload.php';

      use Application\core\App;
      use Application\core\Controller;

      $app = new App();

    ?>

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

    <script src="~/lib/jquery/dist/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->


    <script src="/assets/js/jquery.slim.min.js"></script>
    <!-- <script src="/assets/js/bootstrap.min.js"></script> -->

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- <script src="/assets/js/user/chatbot.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    <script>
      // var input = document.getElementById('data');

      // input.addEventListener('focus', () => {

      // })

      $(document).ready(function(){
        $nivel = $("#nivel").val();
        $("#send-btn").on("click", function(){
          $value = $("#data").val();
          $msg = '<div class="user-inbox inbox"><div class="msg-header"><p class="text-break">'+ $value +'</p></div></div>';
          $(".form").append($msg);
          $("#data").val('');

          $nivel++;
          $("#nivel").val($nivel);

          $estado       = '';
          $cidade       = '';
          $preferencia  = '';

          if($nivel == 2){
            $estado = $value;
          }
          if($nivel == 3){
            $cidade = $value;
          }
          if($nivel == 4){
            $preferencia = $value;
          }
          
          // start ajax code
          $.ajax({
            url: '../../message.php',
            type: 'POST',
            // data: 'text='+$value,
            data: {text: $value, nivel: $nivel, estado: $estado, cidade: $cidade, preferencia: $preferencia},
            success: function(result){
              if(result == "Desculpe, não consegui te entender" || result == "Desculpe, não encontrei informações relacionadas"){
                $nivel--;
                $("#nivel").val($nivel);

                $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ result +'. Tente responder novamente</p></div></div>';
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
                $nivel = 0;
                $("#nivel").val($nivel);

                $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ result +'</p></div></div>';
                $(".form").append($replay);
                $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ '<a href="#" class="text-white" onclick="window.location.reload()">Recomeçar</a>' +'</p></div></div>';
                $(".form").append($replay);
                // when chat goes down the scroll bar automatically comes to the bottom
                $(".form").scrollTop($(".form")[0].scrollHeight);
              }
              else{
                $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ result +'</p></div></div>';
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

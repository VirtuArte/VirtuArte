<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>VirtuArte</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
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
      <div>oi</div> 
      <a href="/user/logout" class="nav-link">Sair</a>
      <?php $nivelChat = 0 ?>
      <div class="wrapper">
        <div class="title">Simple Online Chatbot</div>
        <div class="form">
          <div class="bot-inbox inbox">
            <div class="icon">
              <i class="fas fa-user"></i>
            </div>
            <div class="msg-header">
              <p>Olá, eu sou o Vitu! Em que posso te ajudar?</p>
              <input type="text" id="nivel" value="<?= $nivelChat ?>">
            </div>
          </div>
        </div>
        <div class="typing-field">
          <div class="input-data">
            <input id="data" type="text" placeholder="Type something here.." required>
            <button id="send-btn">Send</button>
          </div>
        </div>
      </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="/assets/js/jquery.slim.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- <script src="/assets/js/user/chatbot.js"></script> -->

    <script>
      // var input = document.getElementById('data');

      // input.addEventListener('focus', () => {

      // })

      $(document).ready(function(){
        $("#send-btn").on("click", function(){
          $value = $("#data").val();
          $msg = '<div class="user-inbox inbox"><div class="msg-header"><p class="text-break">'+ $value +'</p></div></div>';
          $(".form").append($msg);
          $("#data").val('');
          
          $nivel = $("#nivel").val();
          $nivel++;
          
          $("#nivel").val($nivel);
          // start ajax code
          $.ajax({
            url: 'message.php',
            type: 'POST',
            // data: 'text='+$value,
            data: {text: $value, nivel: $nivel},
            success: function(result){
              if(result == "Desculpe, não consegui te entender"){
                console.log($nivel);
              }
              $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p class="text-break">'+ result +'</p></div></div>';
              $(".form").append($replay);
              // when chat goes down the scroll bar automatically comes to the bottom
              $(".form").scrollTop($(".form")[0].scrollHeight);
            }
          });
        });
      });
    </script>

  </body>
</html>

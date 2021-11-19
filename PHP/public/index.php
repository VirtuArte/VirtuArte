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
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-md navbar-toggleable-sm navbar-light bg-white border-bottom box-shadow mb-3 fixed-top">
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
                <button class="bg-purple" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropLogin">Entrar</button>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </header>    

    <?php
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
  </body>
</html>

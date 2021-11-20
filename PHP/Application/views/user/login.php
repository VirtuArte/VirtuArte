<link rel="stylesheet" href="/assets/css/index/index.css">

<section id="signup" class="h-100 w-100 container">
    <div class="row align-items-center mt-5">
    <div class="modal-body p-0 row min-vh-75">
        <div class="col-7 d-flex align-items-center justify-content-center">
          <div class="container ms-5 me-5">
            <div class="d-flex">
              <img src="/assets/img/logo.png" class="mx-auto mb-5 img-form" alt="Logo VirtuArte">
            </div>
            <?php flash('login') ?>
            <form action="/user/open" method="post">
              <input type="hidden" name="type" value="login">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingLoginUsername" name="floatingLoginUsername" placeholder="name@example.com">
                <label for="floatingLoginUsername">E-mail ou Nome de Usuário</label>
              </div>
              <div class="form-floating d-flex position-relative">
                <input type="password" class="form-control" id="floatingLoginPassword" name="floatingLoginPassword" placeholder="Password">
                <label for="floatingLoginPassword">Senha</label>
                <span class="input-group-text position-absolute h-100 end-0" id="basic-addon2" onclick="password_show_hide()">
                  <i class="glyphicon glyphicon-eye-close me-2" id="show_eye"></i>
                  <i class="glyphicon glyphicon-eye-open me-2 d-none" id="hide_eye"></i>
                </span>
              </div>
              <div class="button d-flex justify-content-center mb-2 mt-4">
                <button class="bg-blue btn btn-form" type="submit">Entrar</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-5 p-0 position-relative right-config">
          <div class="background-style-up"></div>
          <div class="background-form">
          </div>
          <div class="container d-flex justify-content-center top-40 position-absolute m-auto">
            <div class="modal-option">
              <h4>NÃO POSSUI CADASTRO?</h4>
              <div class="button d-flex justify-content-center mb-2 mt-4">
                <button class="bg-blue btn btn-form px-4 d-flex align-items-center" type="button">
                    <a href="/user/cadastrar" class="nav-link text-white">Cadastre-se</a>
                </button>
              </div>
            </div>
          </div>
          <div class="background-style-down"></div>
        </div>
      </div>
    </div>
</section>
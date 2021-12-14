<link rel="stylesheet" href="/assets/css/index/index.css">

<section id="signup" class="h-100 w-100 container">
    <div class="row align-items-center mt-5">
        <div class="modal-body p-0 row bg-white">
          <div class="col-7 d-flex align-items-center justify-content-center py-5">
            <div class="container ms-5 me-5">
              <div class="d-flex">
                <img src="/assets/img/logo.png" class="mx-auto mb-5 img-form" alt="Logo VirtuArte">
              </div>
              <?php flash('register') ?>
              <form action="/user/register" method="post">
                <input type="hidden" name="type" value="register">
                <div class="d-flex justify-content-between mb-3">
                  <label for="">Você é </label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="typeProfile" id="type1" value="pessoal" onclick="typeAccount()">
                    <label class="form-check-label" for="type1">
                      Pessoa Física
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="typeProfile" id="type2" value="comercial" onclick="typeAccount()">
                    <label class="form-check-label" for="type2">
                      Pessoa Jurídica
                    </label>
                  </div>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="floatingSignInName" name="floatingSignInName" placeholder="Berga Motta">
                  <label for="floatingSignInName">Nome</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="floatingSignInUsername" name="floatingSignInUsername" placeholder="@bergamotta">
                  <label for="floatingSignInUsername">Nome de Usuário</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="floatingSignInEmail" name="floatingSignInEmail" placeholder="name@example.com">
                  <label for="floatingSignInEmail">E-mail</label>
                </div>
                <div class="form-floating d-flex position-relative mb-3">
                  <input type="password" class="form-control" id="floatingSignInPass" name="floatingSignInPass" placeholder="Password" data-bs-toggle="tooltip" data-bs-placement="top" title="A senha deve ter no mínimo 6 caracteres">
                  <label for="floatingSignInPass">Senha <span class="text-danger">*</span></label>
                  <span class="input-group-text position-absolute h-100 end-0" id="basic-addon2" onclick="password_show_hide()">
                    <i class="glyphicon glyphicon-eye-close me-2" id="show_eye"></i>
                    <i class="glyphicon glyphicon-eye-open me-2 d-none" id="hide_eye"></i>
                  </span>
                </div>
                <div class="form-floating d-flex position-relative mb-3">
                  <input type="password" class="form-control" id="floatingSignInConfirmPass" name="floatingSignInConfirmPass" placeholder="Password">
                  <label for="floatingSignInConfirmPass">Confirme sua senha</label>
                  <span class="input-group-text position-absolute h-100 end-0" id="basic-addon2" onclick="password_show_hide()">
                    <i class="glyphicon glyphicon-eye-close me-2" id="show_eye"></i>
                    <i class="glyphicon glyphicon-eye-open me-2 d-none" id="hide_eye"></i>
                  </span>
                </div>
                <div id="additional" class="mt-4">
                  
                </div>
                <div class="d-flex my-3 align-items-sm-baseline">
                  <input type="checkbox" name="floatingSignInTerms" id="floatingSignInTerms" required>
                  <label class="mx-2" for="floatingSignInTerms">Declaro que li e concordo com os <a href="#">Termos de Uso</a> e <a href="#">Privacidade</a>.</label>
                </div>
                <div class="button d-flex justify-content-center mb-2 mt-4">
                  <button class="bg-blue btn btn-form px-4" type="submit">Cadastrar</button>
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
                <h4>JÁ POSSUI CADASTRO?</h4>
                <div class="button d-flex justify-content-center mb-2 mt-4">
                  <button class="bg-blue btn btn-form px-4 d-flex align-items-center" type="button">
                    <a href="/user/login" class="nav-link text-white">Entrar</a>
                  </button>
                </div>
              </div>
            </div>
            <div class="background-style-down"></div>
          </div>
        </div>
    </div>
</section>

<script>
 
</script>

<!-- <link rel="stylesheet" href="/assets/css/index/index.css"> -->
<script src="/assets/js/index/index.js"></script>

<link rel="stylesheet" href="./assets/css/index/index.css">

<div class="start-0 d-flex justify-content-center mt-5 pt-5">
  <img class="position-absolute" src="./assets/img/logo_home.png" />
  <img class="w-100" src="./assets/img/quadrados_home.png" alt="Quadrados Coloridos" />
</div>

<section id="about" class=" container mt-5 pt-5">
  <div class="d-flex gap-3 mt-5">
    <img class="mockup-home" src="./assets/img/mockup_home.png" alt="MockUp Tela VirtuArte">
    <div class="about-1 d-flex flex-column justify-content-center">
      <h2>Perfis pessoais e comerciais para você espalhar cultura</h2>
      <h4>Compartilhe suas experiências</h4>
    </div>
  </div>
  
  <div class="about-2 mt-5 h-100">
    <h2 class="mb-5 w-50">Conheça o Vitu</h2>
    <div class="d-flex justify-content-around align-items-center">
      <img class="" src="./assets/img/chat_home.png" alt="Conversa com o ChatBot Vitu">
      <img class="vitu"src="./assets/img/vitu.gif" alt="Foto Vitu (Chatbot do VirtuArte)">
    </div>    
  </div>
</section>

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

<script src="./assets/js/index/index.js"></script>
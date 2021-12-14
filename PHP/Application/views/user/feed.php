<link rel="stylesheet" href="/assets/css/user/feed.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<?php if(isset($_SESSION['usersId'])){ ?>

    <header>
        <?php foreach($data['user'] as $user) : ?>
        <nav class="navbar navbar-expand-md navbar-toggleable-sm navbar-light bg-white border-bottom box-shadow mb-3 fixed-top">
          <div class="container justify-content-between">
            <a class="navbar-brand" href="/user/feed">
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
              <img src="<?= isset($user['foto_perfil']) ? $user['foto_perfil'] : "/assets/img/perfil.jpg" ?>" class="profilePicNav">
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
        <?php break; endforeach; ?>
      </header>

<div class="general pb-5">
    <div class="container d-flex mt-5">
        <?php foreach($data['user'] as $user) : ?>
        <aside class="nav-aside">
            <div class="profile d-flex flex-column">
                <div class="container px-4 py-4">
                    <div class="information-profile d-flex flex-column align-items-center pt-4">
                        <img src="<?= isset($user['foto_perfil']) ? $user['foto_perfil'] : "/assets/img/perfil.jpg" ?>" class="profilePicAside">
                        <div class="name-profile d-flex flex-column align-items-center pt-4 pb-4 gap-2">
                            <h3><?= $firstName.' '.$lastName ?></h3>
                            <h4><?= '@'.$user['username'] ?></h4>
                        </div>
                    </div>

                    <div class="score-profile">
                        <div class="score-post d-flex justify-content-between pt-4 pb-3">
                            <h4>Total de postagens</h4>
                            <p><?= sizeof($data['post']) ?></p>
                        </div>

                        <div class="score-avaliation d-flex justify-content-between pb-4">
                            <h4>Avaliações realizadas</h4>
                            <p>0</p>
                        </div>
                    </div>

                    <!-- COLOCAR REDIRECIONAMENTO DOS LINKS e ALINHAR IMAGEM COM ÍCONE -->
                    <div class="navegation-profile d-flex flex-column gap-4 pb-4">
                        <a class="d-flex align-items-center" href="/user/feed"><img class="pe-2" src="/assets/img/icon-home.svg" alt="Ícone home"> Página inicial</a>
                        <a class="d-flex align-items-center" href="/user/profile/<?= (int)$_SESSION['usersId'] ?>"><img class="pe-2" src="/assets/img/icon-profile.svg" alt="Ícone perfil"> Perfil</a>
                        <a class="d-flex align-items-center" href="" data-bs-toggle="modal" data-bs-target="#newPost"><img class="pe-2" src="/assets/img/icon-plus.svg" alt="Ícone mais"> Nova publicação</a>
                        <a class="d-flex align-items-center" href=""><img class="pe-2" src="/assets/img/icon-config.svg" alt="Ícone configurações">Configurações</a>
                    </div>
                </div>
            </div>

            <!-- Modal New Post -->
            <div class="modal fade" id="newPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content border-acordion p-3">
                        <form action="/user/publish" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title d-flex align-items-center" id="exampleModalLabel"><img class="pe-2" src="/assets/img/icon-plus.svg" alt="Ícone mais"> Nova publicação</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Escreva uma legenda.." id="floatingTextarea" name="legend" maxlength="550"></textarea>
                                            <label for="floatingTextarea">Escreva uma legenda...</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group mb-3 select dz-clickable form-control d-flex justify-content-center" id="inputGroupFile01" onchange="readFile(event)">
                                            <div class="dz-default dz-message d-flex flex-column justify-content-center align-items-center" data-dz-message="">
                                                <label for="inputBanner" id="labelFile">Selecione o arquivo</label>                                
                                                <input type="file" class="d-none" id="inputBanner" name="inputBanner" onchange="readFile(event)" required>
                                                <span id="alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="previewArea" class="mt-2">
                                    <div class="input-group my-5 dropzone dz-clickable form-control d-flex justify-content-center">
                                        <div class="dz-default dz-message d-flex flex-column justify-content-center align-items-center" data-dz-message="">
                                            <img src="" alt="" id="postPreview">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="dragData">
                                        <input id="fileDragName" name="fileDragName">
                                        <input id="fileDragSize" name="fileDragSize">
                                        <input id="fileDragType" name="fileDragType">
                                        <input id="fileDragData" name="fileDragData">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-publish" id="publish">Publicar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                
            <!-- <div class="chatbot mt-5">
                <div class="container px-4 py-4">
                    <h3>Aqui vai o chatbot, escrevi isso só para div aparecer :</h3>
                    <?php
                        // include 'chatbot.php';
                    ?>
                </div>
            </div> -->

            <div class="position-relative" style="top: 43.5rem">
                <div class="suggestions border-acordion mt-5 position-relative">
                    <div class="suggestion">
                        <div class="accordion border-acordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item border-acordion">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                    <button class="accordion-button border-acordion" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                        Sugestões para você
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show position-relative" aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body">
                                        <div>
                                            <?php foreach($data['suggestion'] as $suggestion) { ?>
                                            <?php 
                                                $suggestionName = explode(" ", $suggestion['nome']);
                                                $firstSuggestionName = $suggestionName[0];
                                                $lastSuggestionName = sizeof($suggestionName) > 1 ? $suggestionName[sizeof($suggestionName) - 1] : ''
                                            ?>
                                            <div class="sugest d-flex mt-3 mb-3">
                                                <div class="sugest d-flex">
                                                    <img src="<?= isset($suggestion['foto_perfil']) ? $suggestion['foto_perfil'] : "/assets/img/perfil.jpg" ?>" class="profilePicSuggestion">
                                                    <div class="nome">
                                                        <a class="text-black links" href="/user/profile/<?= (int)$suggestion['id_usuario'] ?>"><?= $firstSuggestionName.' '.$lastSuggestionName ?></a>
                                                        <a class="text-black links" href="/user/profile/<?= (int)$suggestion['id_usuario'] ?>"><?= '@'.$suggestion['username'] ?></a>
                                                    </div>
                                                </div>
                                                <?php 
                                                $status = 'follow';
                                                if(isset($data['following'])){
                                                    foreach($data['following'] as $folowing) { 
                                                        if($folowing['id_usuario'] == $suggestion['id_usuario']){
                                                            $status = "unfollow";
                                                        } 
                                                    }
                                                }
                                                ?>
                                                <a href="/user/follow/<?= (int)$suggestion['id_usuario'] ?>/<?= $status ?>" class="text-black links text-end"><span class="links"><?= $status == 'follow' ? 'Seguir' : 'Deixar de seguir' ?></span></a>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer>
                    <div class="row justify-content-between mt-4">
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
                </footer>
            </div>
        </aside>
        <?php break; endforeach; ?>

        <main>
            <section class="mx-5 feed w-100 row justify-content-center" style="margin-top: -3rem;">
                    <?php if(sizeof($data['post']) == 0){ ?>
                        <div class="w-100 h-25 d-flex flex-column align-items-center justify-content-center my-5">
                            <img src="/assets/img/vitu-chat.png" alt="" width="75" class="m-5">
                            <h2>Ainda não há publicações</h2>
                        </div>
                    <?php } else { ?>
                    <?php foreach($data['feed'] as $post) { ?>
                    <div class="feed-posts position-relative w-post m-3 mt-0">
                        <div class="dates d-flex align-items-center gap-4 position-relative">
                            <img src="<?= isset($post['foto_perfil']) ? $post['foto_perfil'] : "/assets/img/perfil.jpg" ?>" class="profilePicPost">
                            <div class="creator">
                                <?php 
                                    $namePost = explode(" ", $post['nome']);
                                    $firstNamePost = $namePost[0];
                                    $lastNamePost = sizeof($namePost) > 1 ? $namePost[sizeof($namePost) - 1] : ''
                                ?>
                                <h4><a href="/user/profile/<?= $post['id_usuario'] ?>"><?= $firstNamePost.' '.$lastNamePost ?></a></h4>
                                <?php 
                                    $date = $post['data_publicacao'];
                                    $date = strtotime($post['data_publicacao']);
                                    $date = date( 'd.m.Y', $date );
                                ?>
                                <p><?= $date ?></p>
                            </div>
                        </div>
        
                        <div class="background position-relative w-fit-content">
                            <div>
                                <img class="d-block shadow-sm w-100 h-post" src="<?= $post['midia'] ?>" alt="Exposição de arte">
                            </div>
                            <div class="legend carousel-caption bottom-0 p-0">
                                <p class="text-break m-0"><?= $post['legenda'] ?></p>
                            </div>
        
                            <div class="interaction position-absolute d-flex gap-3">
                                <div class="like">
                                <a href="/user/toLike/<?= $post['id_publicacao'] ?>/like" id="btn-like">
                                        <img src="/assets/img/like-disabled.svg" alt="Botão de like">
                                    </a>
                                </div>
        
                                <div class="coment">
                                    <a id="btn-coment">
                                        <img src="/assets/img/comment.svg" alt="Botão de comentar">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }} ?>       
                    
                
                    <!-- COLOCAR MINI FOOTER AQUI -->
                </section>
        </main>
    </div>
    <?php 
        }
        else{
            header('Location: /user/login');
        }
    ?>
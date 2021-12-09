<link rel="stylesheet" href="/assets/css/user/feed.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<?php if(isset($_SESSION['usersId'])){ ?>

<div class="general">
    <div class="container d-flex mt-5">
        <aside class="nav-aside">
            <div class="profile d-flex flex-column">
                <div class="container px-4 py-4">
                    <div class="information-profile d-flex flex-column align-items-center pt-4">
                        <img src="/assets/img/foto-luna.png" alt="Foto Luna">
                        <div class="name-profile d-flex flex-column align-items-center pt-4 pb-4 gap-2">
                            <h3>Luna Maria</h3>
                            <h4>@LunaM</h4>
                        </div>
                    </div>

                    <div class="score-profile">
                        <div class="score-post d-flex justify-content-between pt-4 pb-3">
                            <h4>Total de postagens</h4>
                            <p>256</p>
                        </div>

                        <div class="score-avaliation d-flex justify-content-between pb-4">
                            <h4>Avaliações Realizadas</h4>
                            <p>301</p>
                        </div>
                    </div>

                    <!-- COLOCAR REDIRECIONAMENTO DOS LINKS e ALINHAR IMAGEM COM ÍCONE -->
                    <div class="navegation-profile d-flex flex-column gap-4 pb-4">
                        <a class="d-flex align-items-center" href="/user/feed"><img class="pe-2" src="/assets/img/icon-home.svg" alt="Ícone home"> Página inicial</a>
                        <a class="d-flex align-items-center" href=""><img class="pe-2" src="/assets/img/icon-profile.svg" alt="Ícone perfil"> Perfil</a>
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
                                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="legend" maxlength="550"></textarea>
                                            <label for="floatingTextarea">Escreva uma legenda...</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group mb-3 select dz-clickable form-control d-flex justify-content-center" id="inputGroupFile01" onchange="readFile(event)">
                                            <div class="dz-default dz-message d-flex flex-column justify-content-center align-items-center" data-dz-message="">
                                                <label for="inputBanner" id="labelFile">Selecione o arquivo</label>                                
                                                <input type="file" class="d-none" id="inputBanner" name="inputBanner" onchange="readFile(event)">
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
                                <button type="submit" class="btn btn-publish">Publicar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                
            <div class="chatbot mt-5">
                <div class="container px-4 py-4">
                    <h3>Aqui vai o chatbot, escrevi isso só para div aparecer :</h3>
                    <?php
                        // include 'chatbot.php';
                    ?>
                </div>
                
            </div>
            <div class="suggestions border-acordion mt-5">
                <div class="container p-0">

                    <!-- COLOCAR LINKS NOS @'S -->

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
                                            <div class="sugest d-flex mt-2 mb-2">
                                                <div class="sugest d-flex">
                                                    <img src="/assets/img/foto-suzana-v.svg">
                                                    <div class="nome">
                                                        <a class="text-black links">Suzana Vieira</a>
                                                        <a class="text-black links">@suzanavieira</a>
                                                    </div>
                                                </div>
                                                <span class="links">Seguir</span>
                                            </div>

                                            <div class="sugest d-flex mt-2 mb-2">
                                                <div class="sugest d-flex">
                                                    <img src="/assets/img/foto-jojo-t.svg">
                                                    <div class="nome">
                                                        <a class="text-black links">Jojo Toddynho</a>
                                                        <a class="text-black links">@jojguerreira</a>
                                                    </div>
                                                </div>
                                                <span class="links">Seguir</span>
                                            </div>

                                            <div class="sugest d-flex mt-2 mb-2">
                                                <div class="sugest d-flex">
                                                    <img src="/assets/img/foto-anitta.svg">
                                                    <div class="nome">
                                                        <a class="text-black links">Anitta</a>
                                                        <a class="text-black links">@anitta</a>
                                                    </div>
                                                </div>
                                                <span class="links">Seguir</span>
                                            </div>

                                            <div class="sugest d-flex mt-2 mb-2">
                                                <div class="sugest d-flex">
                                                    <img src="/assets/img/foto-suzane-r.svg">
                                                    <div class="nome">
                                                        <a class="text-black links">Su</a>
                                                        <a class="text-black links">@surichthofen</a>
                                                    </div>
                                                </div>
                                                <span class="links">Seguir</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <main>
            <div class="mx-5 feed d-inline-flex">
                <div class="feed-posts position-relative w-post m-3 mt-0">
                    <div class="dates d-flex align-items-center gap-4 position-relative">
                        <img src="/assets/img/foto-lua.svg" alt="Foto Lua Marina">
                        <div class="creator">
                            <h4>Lua Marina</h4>
                            <p>08.12.2019</p>
                        </div>
                    </div>
    
                    <div class="background position-relative w-fit-content">
                        <div>
                            <img class="d-block shadow-sm w-100" src="/assets/img/post-1.svg" alt="Exposição de arte">
                        </div>
                        <div class="legend carousel-caption bottom-0 p-0">
                            <p class="text-break m-0">A vida é uma obra de arte, sempre bom ver uma exposição. - Pinacoteca São Paulo</p>
                        </div>
    
                        <div class="interaction position-absolute d-flex gap-3">
                            <div class="like">
                                <button id="btn-like">
                                    <img src="/assets/img/like-disabled.svg" alt="Botão de like">
                                </button>
                            </div>
    
                            <div class="coment">
                                <button id="btn-coment">
                                    <img src="/assets/img/comment.svg" alt="Botão de comentar">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="feed-posts position-relative w-post m-3 mt-0">
                    <div class="dates d-flex align-items-center gap-4 position-relative">
                        <img src="/assets/img/foto-lua.svg" alt="Foto Lua Marina">
                        <div class="creator">
                            <h4>Lua Marina</h4>
                            <p>08.12.2019</p>
                        </div>
                    </div>
    
                    <div class="background position-relative w-fit-content">
                        <div>
                            <img class="d-block shadow-sm w-100" src="/assets/img/post-1.svg" alt="Exposição de arte">
                        </div>
                        <div class="legend carousel-caption bottom-0 p-0">
                            <p class="text-break m-0">A vida é uma obra de arte, sempre bom ver uma exposição. - Pinacoteca São Paulo</p>
                        </div>
    
                        <div class="interaction position-absolute d-flex gap-3">
                            <div class="like">
                                <button id="btn-like">
                                    <img src="/assets/img/like-disabled.svg" alt="Botão de like">
                                </button>
                            </div>
    
                            <div class="coment">
                                <button id="btn-coment">
                                    <img src="/assets/img/comment.svg" alt="Botão de comentar">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
    
                
            
                <!-- COLOCAR MINI FOOTER AQUI -->
            </div>
        </main>
    </div>
    <?php 
        }
        else{
            header('Location: /user/login');
        }
    ?>

<script src="/assets/js/user/feed.js"></script>
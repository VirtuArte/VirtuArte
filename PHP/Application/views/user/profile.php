<link rel="stylesheet" href="/assets/css/user/profile.css">

<div class="general">
    <div class="container d-flex mt-5">
            <aside class="nav-aside">
                <div class="profile d-flex flex-column">
                    <div class="container px-4 py-4">
                        <div class="navegation-profile d-flex flex-column gap-4 py-3">
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
                                                <div class="sugest d-flex mt-2 mb-2">
                                                    <div class="sugest d-flex">
                                                        <img src="/assets/img/foto-suzana-v.svg">
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
                </div>
            </aside>
            <main class="mx-5 w-100">
                <div class="profile align-center d-flex bg-white">
                    <div class="d-flex p-5">
                        
                        <img src="/assets/img/foto-luna.png" style="width: 35%">
                        <div class="perfil">
                            <div class="name-profile">
                                <?php 
                                    $name = explode(" ", $_SESSION['usersName']);
                                    $firstName = $name[0];
                                    $lastName = sizeof($name) > 1 ? $name[sizeof($name) - 1] : ''
                               ?>
                                <h3><?= $firstName.' '.$lastName ?></h3>
                                <?php foreach($data['user'] as $user): ?>
                                <h4><?= '@'.$user['username'] ?></h4>
                                <?php break; endforeach ?>
                            </div>
                            <div class="perfil2">
                                <div class="sugest m-2 d-flex">
                                    <span>Total de posts</span>
                                    <span class="mx-4"><?= sizeof($data['post']) ?></span>
                                </div>
                                <div class="sugest m-2 d-flex">
                                    <span>Avaliações Realizadas</span>
                                    <span class="mx-4">301</span>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>

                <section class="feed w-100">
                    <?php if(sizeof($data['post']) == 0){ ?>
                        <div class="w-100 h-25 d-flex flex-column align-items-center justify-content-center my-5">
                            <img src="/assets/img/vitu-chat.png" alt="" width="75" class="m-5">
                            <h2>Ainda não há publicações</h2>
                        </div>
                    <?php } else { ?>
                    <?php foreach($data['post'] as $post) { ?>
                    <div class="feed-posts position-relative w-post m-3 mt-0">
                        <div class="dates d-flex align-items-center gap-4 position-relative">
                            <img src="/assets/img/foto-lua.svg" alt="Foto Lua Marina">
                            <div class="creator">
                                <h4><?= $firstName.' '.$lastName ?></h4>
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
                    <?php }} ?>
                    <!-- <div class="feed-posts position-relative w-post m-3 mt-0">
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
                    </div> -->
        
                    
                
                    <!-- COLOCAR MINI FOOTER AQUI -->
                </section>
            </main>
    </div>      
</div>
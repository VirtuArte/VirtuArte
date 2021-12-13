<link rel="stylesheet" href="/assets/css/user/profile.css">
<script src="/assets/js/user/feed.js"></script>

<header>
    <?php foreach ($data['user'] as $user) : ?>
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
                    <?php foreach ($data['nav'] as $nav) : ?>
                        <img src="<?= isset($nav['foto_perfil']) ? $nav['foto_perfil'] : "/assets/img/perfil.jpg" ?>" class="profilePicNav">
                    <?php break;
                    endforeach; ?>
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
                            <li><a class="dropdown-item" href="/user/profile/<?= (int)$_SESSION['usersId'] ?>">Abrir
                                    perfil</a></li>
                            <li><a class="dropdown-item text-danger" href="/user/logout">Sair</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    <?php break;
    endforeach; ?>
</header>

<div class="general pb-5">
    <div class="container d-flex mt-5">
        <aside class="nav-aside">
            <div class="profile d-flex flex-column">
                <div class="container px-4 py-4">
                    <div class="navegation-profile d-flex flex-column gap-4 py-3">
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
                                <h5 class="modal-title d-flex align-items-center" id="exampleModalLabel"><img class="pe-2" src="/assets/img/icon-plus.svg" alt="Ícone mais"> Nova publicação
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <textarea class="form-control w-100 resize-none" placeholder="Escreva uma legenda.." id="floatingTextarea" name="legend" maxlength="550"></textarea>
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

            <div class="suggestions border-acordion mt-5 position-relative" style="top: 43rem">
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
                                            <?php foreach ($data['suggestion'] as $suggestion) { ?>
                                                <?php
                                                $suggestionName = explode(" ", $suggestion['nome']);
                                                $firstSuggestionName = $suggestionName[0];
                                                $lastSuggestionName = sizeof($suggestionName) > 1 ? $suggestionName[sizeof($suggestionName) - 1] : ''
                                                ?>
                                                <div class="sugest d-flex mt-3 mb-3">
                                                    <div class="sugest d-flex">
                                                        <img src="<?= isset($suggestion['foto_perfil']) ? $suggestion['foto_perfil'] : "/assets/img/perfil.jpg" ?>" class="profilePicSuggestion">
                                                        <div class="nome">
                                                            <a class="text-black links" href="/user/profile/<?= (int)$suggestion['id_usuario'] ?>"><?= $firstSuggestionName . ' ' . $lastSuggestionName ?></a>
                                                            <a class="text-black links" href="/user/profile/<?= (int)$suggestion['id_usuario'] ?>"><?= '@' . $suggestion['username'] ?></a>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $status = 'follow';
                                                    if (isset($data['following'])) {
                                                        foreach ($data['following'] as $folowing) {
                                                            if ($folowing['id_usuario'] == $suggestion['id_usuario']) {
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
            <?php foreach ($data['user'] as $user) : ?>
                <div class="profile align-center d-flex bg-white">
                    <div class="d-flex p-5">
                        <?php
                        $id = $_SESSION['usersId'];
                        if ($_SERVER['REQUEST_URI'] == "/user/profile/$id") {
                        ?>
                            <div class="modal fade" id="newPhotoProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content border-acordion p-3">
                                        <form action="/user/publishPhotoProfile" method="post">
                                            <div class="modal-header">
                                                <h5 class="modal-title d-flex align-items-center" id="exampleModalLabel">Trocar foto de perfil</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="input-group mb-3 select dz-clickable form-control d-flex justify-content-center" id="inputGroupPhoto01" onchange="readPhotoProfile(event)">
                                                            <div class="dz-default dz-message d-flex flex-column justify-content-center align-items-center" data-dz-message="">
                                                                <label for="inputPhoto" id="labelPhoto">Selecione o arquivo</label>
                                                                <input type="file" class="d-none" id="inputPhoto" name="inputPhoto" onchange="readPhotoProfile(event)" required>
                                                                <span id="alert2"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="previewPhoto" class="mt-2">
                                                    <div class="input-group my-5 dropzone dz-clickable form-control d-flex justify-content-center">
                                                        <div class="dz-default dz-message d-flex flex-column justify-content-center align-items-center" data-dz-message="">
                                                            <img src="" alt="" id="photoPreview">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="dragData">
                                                        <input id="photoDragName" name="photoDragName">
                                                        <input id="photoDragSize" name="photoDragSize">
                                                        <input id="photoDragType" name="photoDragType">
                                                        <input id="photoProfile" name="photoProfile">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-publish" id="save">Salvar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray mx-3 profilePic position-relative" style="background-image: url('<?= isset($user['foto_perfil']) ? $user['foto_perfil'] : "/assets/img/perfil.jpg" ?>')">
                                <label id="labelChangePhoto" class="d-flex align-items-center justify-content-center profileLabel profilePic w-100 h-100 p-5 text-center" data-bs-toggle="modal" data-bs-target="#newPhotoProfile">Trocar foto de perfil</label>
                                <!-- <input type="file" class="d-none" id="inputBanner" name="inputBanner" onchange="readPhotoProfile(event)"> -->
                            </div>
                        <?php } else { ?>
                            <img src="<?= isset($user['foto_perfil']) ? $user['foto_perfil'] : "/assets/img/perfil.jpg" ?>" class="profilePic">
                        <?php } ?>
                        <div class="perfil">
                            <div class="name-profile">
                                <?php
                                $name = explode(" ", $user['nome']);
                                $firstName = $name[0];
                                $lastName = sizeof($name) > 1 ? $name[sizeof($name) - 1] : ''
                                ?>
                                <h3><?= $firstName . ' ' . $lastName ?></h3>
                                <h4><?= '@' . $user['username'] ?></h4>
                            </div>
                            <div class="perfil2">
                                <div class="sugest m-2 d-flex">
                                    <span>Total de postagens</span>
                                    <span class="mx-4"><?= sizeof($data['post']) ?></span>
                                </div>
                                <div class="sugest m-2 d-flex">
                                    <span>Avaliações realizadas</span>
                                    <span class="mx-4">0</span>
                                </div>

                                <div class="modal fade" id="modalFollow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content border-acordion p-3">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Seguindo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php foreach ($data['following'] as $following) { ?>
                                                    <div class="feed-posts position-relative w-post m-3 mt-0">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="dates d-flex align-items-center gap-4">
                                                                <img src="<?= isset($user['foto_perfil']) ? $user['foto_perfil'] : "/assets/img/perfil.jpg" ?>" class="profilePicPost">
                                                                <div class="creator">
                                                                    <h4><?= $following['nome'] ?></h4>
                                                                </div>
                                                            </div>
                                                            <a href="/user/follow/<?= (int)$following['id_usuario'] ?>/unfollow" class="text-black links text-end"><span class="links">Deixar de seguir</span></a>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php if (sizeof($data['following']) == 0) { ?>
                                                    <div class="w-100 h-25 d-flex flex-column align-items-center justify-content-center my-5">
                                                        <img src="/assets/img/vitu-chat.png" alt="" width="75" class="m-5">
                                                        <h2>Você ainda não segue ninguém</h2>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $id = $_SESSION['usersId'];
                                if ($_SERVER['REQUEST_URI'] == "/user/profile/$id") { ?>
                                    <button id="follow" data-bs-toggle="modal" data-bs-target="#modalFollow">Seguindo</button>
                                <?php } ?>
                            </div>
                        </div>

                    </div>
                </div>

                <section class="feed w-100 row justify-content-center">
                    <?php if (sizeof($data['post']) == 0) { ?>
                        <div class="w-100 h-25 d-flex flex-column align-items-center justify-content-center my-5">
                            <img src="/assets/img/vitu-chat.png" alt="" width="75" class="m-5">
                            <h2>Ainda não há publicações</h2>
                        </div>
                    <?php } else { ?>
                        <?php foreach ($data['post'] as $post) { ?>
                            <div class="feed-posts position-relative w-post m-3 mt-0">
                                <div class="dates d-flex align-items-center gap-4 position-relative">
                                    <img src="<?= isset($user['foto_perfil']) ? $user['foto_perfil'] : "/assets/img/perfil.jpg" ?>" class="profilePicPost">
                                    <div class="creator">
                                        <h4><?= $firstName . ' ' . $lastName ?></h4>
                                        <?php
                                        $date = $post['data_publicacao'];
                                        $date = strtotime($post['data_publicacao']);
                                        $date = date('d.m.Y', $date);
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
                                        <?php
                                        $id = $_SESSION['usersId'];
                                        if ($_SERVER['REQUEST_URI'] == "/user/profile/$id") {
                                        ?>
                                            <div class="trash">
                                                <a href="/user/deletePost/<?= (int)$post['id_publicacao'] ?>" id="btn-like">
                                                    <img style="width: 20px; height: 22px" src="/assets/img/lixeira.png" alt="Botão de Excluir">
                                                </a>
                                            </div>
                                        <?php } ?>
                                        <div class="like">
                                            <?php
                                            $status = 'notlike';
                                            if (isset($data['liked'])) {
                                                foreach ($data['liked'] as $liked) {
                                                    if ($liked['id_publicacao'] == $post['id_publicacao']) {
                                                        $status = "like";
                                                    }
                                                }
                                            }
                                            ?>
                                            <a href="/user/toLike/<?= (int)$post['id_publicacao'] ?>/<?= $status == 'like' ? 'notLike' : 'like' ?>" id="btn-like">
                                                <img style="width: 24px; height: 22px" src="/assets/img/<?= $status == 'like' ? 'like-active.png' : 'like-disabled.png' ?>" alt="Botão de like">
                                            </a>
                                        </div>

                                        <div class="coment">

                                            <!-- Button trigger modal -->
                                            <a data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $post['id_publicacao'] ?> " id="btn-coment">
                                                <img src="/assets/img/comment.svg" alt="Botão de comentar">
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="staticBackdrop<?= $post['id_publicacao'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Comentários</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php foreach ($data['showComment'] as $comment) { ?>
                                                                <?php if ($post['id_publicacao'] == $comment['fk_publicacao_id_publicacao']) { ?>
                                                                    <div class="feed-posts position-relative w-post m-3 mt-0">
                                                                        <div class="dates d-flex align-items-center gap-4">
                                                                            <img src="<?= isset($user['foto_perfil']) ? $user['foto_perfil'] : "/assets/img/perfil.jpg" ?>" class="profilePicPost">
                                                                            <div class="creator">
                                                                                <h4><?= $firstName . ' ' . $lastName ?></h4>
                                                                            </div>
                                                                        </div>

                                                                        <div class="background position-relative w-fit-content">
                                                                            <div>
                                                                                <p class="d-block shadow-sm w-100">
                                                                                    <?= $comment['comentario'] ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php } ?>
                                                            <?php if ($comment['id_interacao'] < 1) { ?>
                                                                <div class="w-100 h-25 d-flex flex-column align-items-center justify-content-center my-5">
                                                                    <img src="/assets/img/vitu-chat.png" alt="" width="75" class="m-5">
                                                                    <h2>Ainda não há comentários</h2>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="/user/publishComment/<?= $post['id_publicacao'] ?>" method="post" class="w-100 d-flex justify-content-between">
                                                                <textarea name="comment" id="comment"></textarea>
                                                                <button type="submit" class="btn" id="btn-submit">Enviar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>


                    <!-- COLOCAR MINI FOOTER AQUI -->
                </section>
            <?php break;
            endforeach ?>
        </main>
    </div>
</div>
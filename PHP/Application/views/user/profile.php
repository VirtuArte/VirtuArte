<link rel="stylesheet" href="/assets/css/user/profile.css">

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
                            <li><a class="dropdown-item" href="/user/profile/<?= (int)$_SESSION['usersId'] ?>">Abrir perfil</a></li>
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

                            <div class="bg-gray mx-3 profilePic position-relative" style="background-image: url('<?= isset($user['foto_perfil']) ? $user['foto_perfil'] : "/assets/img/perfil.jpg" ?>')">
                                <label for="inputBanner" id="labelFile" class="d-flex align-items-center justify-content-center profileLabel profilePic w-100 h-100 p-5 text-center">Trocar foto de perfil</label>
                                <input type="file" class="d-none" id="inputBanner" name="inputBanner" onchange="readFile(event)">
                                <div class="dragData">
                                    <input id="fileDragName" name="fileDragName">
                                    <input id="fileDragSize" name="fileDragSize">
                                    <input id="fileDragType" name="fileDragType">
                                    <input id="fileDragData" name="fileDragData">
                                </div>
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
                                        <div class="like">
                                            <?php
                                            $status = 'toLike';
                                            if (isset($data['liked'])) {
                                                foreach ($data['liked'] as $liked) {
                                                    if ($liked['id_usuario'] == $post['id_usuario']) {
                                                        $status = "notLike";
                                                    }
                                                }
                                            }
                                            ?>
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
                    <?php }
                    } ?>


                    <!-- COLOCAR MINI FOOTER AQUI -->
                </section>
            <?php break;
            endforeach ?>
        </main>
    </div>
</div>
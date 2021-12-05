<link rel="stylesheet" href="/assets/css/user/feed.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<header>
    <nav class="navbar navbar-expand-md navbar-toggleable-sm navbar-light bg-white border-bottom box-shadow mb-3 fixed-top">
        <div class="container justify-content-between">
            <a class="navbar-brand" asp-area="" asp-controller="Home" asp-action="Index">
                <img class="logo" src="/assets/img/logo.png" alt="Logo VirtuArte">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
            <div class="offcanvas offcanvas-end" id="offcanvasNavbar">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body navbar-collapse collapse d-grid align-content-center justify-content-center justify-items-center">
                    <input type="search" id="bar-search" name="bar-search" placeholder="Buscar no VirtuArte">
                    <!-- ARRUMAR LUPA -->
                    <!-- <button><img src="img-feed/icon-search.svg" alt=""></button> -->
                </div>
            </div>

            <!-- <div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                  Luna Maria
                </button>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                  <li><button class="dropdown-item" type="button">Abrir perfil</button></li>
                  <li><button class="dropdown-item" type="button">Sair</button></li>
                </ul>
              </div> -->
            <div class="nav-right d-flex align-items-center">
                <img src="/assets/img/foto-luna-nav.png" alt="Foto Luna Maria">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Luna Maria
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Abrir perfil</a></li>
                        <li><a class="dropdown-item" href="#">Sair</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="general">
    <div class="container">
        <div class="feed row">
            <div class="division-feed col">
                <div class="profile d-flex flex-column w-25 mt-5">
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
                            <a class="d-flex align-items-center" href=""><img class="pe-2" src="/assets/img/icon-home.svg" alt="Ícone home"> Página inicial</a>
                            <a class="d-flex align-items-center" href=""><img class="pe-2" src="/assets/img/icon-profile.svg" alt="Ícone perfil"> Perfil</a>
                            <a class="d-flex align-items-center" href=""><img class="pe-2" src="/assets/img/icon-plus.svg" alt="Ícone mais"> Nova publicação</a>
                            <a class="d-flex align-items-center" href=""><img class="pe-2" src="/assets/img/icon-config.svg" alt="Ícone configurações">Configurações</a>
                        </div>
                    </div>
                </div>
            
                <div class="chatbot w-25 mt-5">
                    <div class="container px-4 py-4">
                        <h3>Aqui vai o chatbot, escrevi isso só para div aparecer :</h3>
                    </div>
                </div>
            
                <div class="suggestions w-25 mt-5">
                    <div class="container px-4 py-4">
            
                        <!-- COLOCAR LINKS NOS @'S -->
                        <div class="suggestion">
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                            Sugestões para você
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                        <div class="accordion-body">
                                            <div class="suggestion-sv d-flex justify-content-around pt-4 pb-4">
                                                <img src="/assets/img/foto-suzana-v.svg" alt="Foto Suzana Vieira">
                                                <div class="name-suggestion">
                                                    <h4>Suzana Vieira</h4>
                                                    <p>@suzanavieira</p>
                                                </div>
                                                <p class="follow">Seguir</p>
                                            </div>
            
                                            <div class="suggestion-jt d-flex justify-content-around pt-4 pb-4">
                                                <img src="/assets/img/foto-jojo-t.svg" alt="Foto Jojo Toddynho">
                                                <div class="name-suggestion">
                                                    <h4>Jojo Toddynho</h4>
                                                    <p>@jojoguerreira</p>
                                                </div>
                                                <p class="follow">Seguir</p>
                                            </div>
            
                                            <div class="suggestion-ant d-flex justify-content-around pt-4 pb-4">
                                                <img src="/assets/img/foto-anitta.svg" alt="Foto Anitta">
                                                <div class="name-suggestion">
                                                    <h4>Anitta Machado</h4>
                                                    <p>@anitta</p>
                                                </div>
                                                <p class="follow">Seguir</p>
                                            </div>
            
                                            <div class="suggestion-sr d-flex justify-content-around pt-4 pb-4">
                                                <img src="/assets/img/foto-suzane-r.svg" alt="Foto Suzane Richthofen">
                                                <div class="name-suggestion">
                                                    <h4>Su Richthofen</h4>
                                                    <p>@su_richthofen</p>
                                                </div>
                                                <p class="follow">Seguir</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="feed-posts col">
                <div class="container">
                    <div class="post-1 position-relative">
                        <div class="profile-p1">
                            <div class="dates d-flex align-items-center gap-4 position-relative">
                                <img src="/assets/img/foto-lua.svg" alt="Foto Lua Marina">
                                <div class="creator">
                                    <h4>Lua Marina</h4>
                                    <p>08.12.2019</p>
                                </div>
                            </div>
                            
                            <div class="post">
                                <div class="background position-absolute">
                                    <img class="d-block shadow-sm" src="/assets/img/post-1.svg" alt="Exposição de arte">
                                    <div class="legend carousel-caption d-none d-md-block">
                                        <p>A vida é uma obra de arte, sempre bom ver uma exposição. - Pinacoteca São Paulo</p>
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
                        </div>
                    </div>

                    <div class="post-1">
                        <div class="profile-p1">
                            <div class="dates d-flex align-items-center gap-4 position-relative">
                                <img src="/assets/img/foto-lua.svg" alt="Foto Lua Marina">
                                <div class="creator">
                                    <h4>Lua Marina</h4>
                                    <p>08.12.2019</p>
                                </div>
                            </div>
                            
                            <div class="post">
                                <div class="background position-absolute">
                                    <img class="d-block shadow-sm" src="/assets/img/post-1.svg" alt="Exposição de arte">
                                    <div class="legend carousel-caption d-none d-md-block">
                                        <p>A vida é uma obra de arte, sempre bom ver uma exposição. - Pinacoteca São Paulo</p>
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
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- COLOCAR MINI FOOTER AQUI -->
        </div>
    
    </div>
</div>

<header>
    <nav class="navbar navbar-expand-md navbar-toggleable-sm navbar-light bg-white border-bottom box-shadow mb-3 fixed-top">
        <div class="container justify-content-between">
            <a class="navbar-brand" asp-area="" asp-controller="Home" asp-action="Index">
                <img class="logo" src="img-feed/logo.png" alt="Logo VirtuArte">
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
                <img src="img-feed/foto-luna-nav.png" alt="Foto Luna Maria">
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


    <div class="container">
        <div class="profile d-flex flex-column w-25 mt-5">
            <div class="container px-4 py-4">
                <div class="information-profile d-flex flex-column align-items-center pt-4">
                    <img src="img-feed/foto-luna.png" alt="Foto Luna">
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
                    <a class="d-flex align-items-center" href=""><img class="pe-2" src="img-feed/icon-home.svg" alt="Ícone home"> Página inicial</a>
                    <a class="d-flex align-items-center" href=""><img class="pe-2" src="img-feed/icon-profile.svg" alt="Ícone perfil"> Perfil</a>
                    <a class="d-flex align-items-center" href=""><img class="pe-2" src="img-feed/icon-plus.svg" alt="Ícone mais"> Nova publicação</a>
                    <a class="d-flex align-items-center" href=""><img class="pe-2" src="img-feed/icon-config.svg" alt="Ícone configurações">Configurações</a>
                </div>
            </div>
        </div>

        <div class="chatbot w-25 mt-5">
            <div class="container px-4 py-4">
                <h3>Aqui vai o chatbot, escrevi isso só para div aparecer </h3>
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
                                        <img src="img-feed/foto-suzana-v.svg" alt="Foto Suzana Vieira">
                                        <div class="name-suggestion">
                                            <h4>Suzana Vieira</h4>
                                            <p>@suzanavieira</p>
                                        </div>
                                        <p class="follow">Seguir</p>
                                    </div>

                                    <div class="suggestion-jt d-flex justify-content-around pt-4 pb-4">
                                        <img src="img-feed/foto-jojo-t.svg" alt="Foto Jojo Toddynho">
                                        <div class="name-suggestion">
                                            <h4>Jojo Toddynho</h4>
                                            <p>@jojoguerreira</p>
                                        </div>
                                        <p class="follow">Seguir</p>
                                    </div>

                                    <div class="suggestion-ant d-flex justify-content-around pt-4 pb-4">
                                        <img src="img-feed/foto-anitta.svg" alt="Foto Anitta">
                                        <div class="name-suggestion">
                                            <h4>Anitta Machado</h4>
                                            <p>@anitta</p>
                                        </div>
                                        <p class="follow">Seguir</p>
                                    </div>

                                    <div class="suggestion-sr d-flex justify-content-around pt-4 pb-4">
                                        <img src="img-feed/foto-suzane-r.svg" alt="Foto Suzane Richthofen">
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

        <!-- COLOCAR MINI FOOTER AQUI -->

    </div>

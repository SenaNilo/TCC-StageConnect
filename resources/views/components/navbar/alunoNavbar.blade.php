<aside class="sidebar collapsed">
            <div class="sidebar-header">
                <img src="{{ asset('images/LogoSFundo.png') }}" alt="Logo StageConnect" class="header-logo">
                <h2 class="titulo-sidebar"> StageConnect </h2>
                <button class="sidebar-toggle">
                    <span class="material-symbols-rounded"> chevron_left </span>
                </button>
            </div>




            <div class="sidebar-content">
                <!-- search form -->
                <!-- <form action="#" class="search-form">
            <span class="material-symbols-rounded">search</span>
            <input type="search" placeholder="Search..." required />
          </form> -->

                <!-- sidebar menu -->
                <ul class="menu-list">
                    <li class="menu-item">
                        <a href="#" class="menu-link active">
                            <span class="material-symbols-rounded">home</span>
                            <span class="menu-label">Página inicial</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="material-symbols-rounded">insert_chart</span>
                            <span class="menu-label">Conteúdo</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="material-symbols-rounded">notifications</span>
                            <span class="menu-label">Conteúdo</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="material-symbols-rounded">star</span>
                            <span class="menu-label">Conteúdo</span>
                        </a>
                    </li>

                </ul>
            </div>



            <!-- Sidebar Footer -->
            <div class="sidebar-footer">
                <button class="theme-toggle">
                    <div class="theme-label">
                        <span class="theme-icon material-symbols-rounded">dark_mode</span>
                        <span class="theme-text">Dark Mode</span>
                    </div>
                    <div class="theme-toggle-track">
                        <div class="theme-toggle-indicator"></div>
                    </div>
                </button>


                <div>


                    <button id="open-modal-btn" type="button" class="menu-link btn-sair">
                        <span class="material-symbols-rounded">login</span>
                        <span class="menu-label"> Sair </span>
                    </button>

                    </form>
                </div>
                <!-- @auth
             <form action="{{ route('logout') }}" method="POST" style="width: 100%;">
        @csrf
        <button type="submit" class="menu-link" style="width: 100%; border: none; background: none;">
            <span class="material-symbols-rounded">logout</span>
            <span class="menu-label">Sair</span>
        </button>
    </form>
    @endauth -->


            </div>
        </aside>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <div id="logout-modal" class="modal-overlay modal-hidden">
            <div class="card-cancelar">
                <div class="header-cancelar">
                    <div class="image">
                        <span class="material-symbols-rounded">warning</span>
                    </div>
                    <div class="content">
                        <span class="title">Sair da Conta</span>
                        <p class="message">
                            Você tem certeza que deseja sair?
                        </p>
                    </div>
                    <div class="actions">
                        <button id="confirm-logout-btn" class="desactivate" type="button">Confirmar</button>
                        <button id="cancel-logout-btn" class="cancel" type="button">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
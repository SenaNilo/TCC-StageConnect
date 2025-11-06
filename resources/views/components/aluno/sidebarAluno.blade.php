  <!-- Sidebar -->
  <aside class="sidebar collapsed">
      <div class="sidebar-header">
          <img src="{{ asset('images/LogoSFundo.png') }}" alt="Logo StageConnect" class="header-logo">
          <h2 class="titulo-sidebar"> StageConnect </h2>
          <button class="sidebar-toggle">
              <span class="material-symbols-rounded"> chevron_left </span>
          </button>
      </div>

      <div class="sidebar-content">
          <!-- sidebar menu -->
          <ul class="menu-list">
              <li class="menu-item">
                  <a href="{{ route('aluno.index') }}" class="menu-link {{ request()->routeIs('aluno.index') ? 'active' : '' }}">
                      <span class="material-symbols-rounded">home</span>
                      <span class="menu-label">Página inicial</span>
                  </a>
              </li>
              <li class="menu-item">
                  <a href="{{ route('aluno.orientacao') }}" class="menu-link {{ request()->routeIs('aluno.orientacao') ? 'active' : '' }}">
                      <span class="material-symbols-rounded">article_person</span>
                      <span class="menu-label">Perfil Profissional</span>
                  </a>
              </li>
              <li class="menu-item">
                  <a href="{{ route('aluno.requisitos' )}}" class="menu-link {{ request()->routeIs('aluno.requisitos') ? 'active' : '' }}">
                      <span class="material-symbols-rounded">Folder_Code</span>
                      <span class="menu-label">Áreas Atuação</span>
                  </a>
              </li>

              <li class="menu-item">
                  <a href="{{ route('aluno.tecnico') }}" class="menu-link {{ request()->routeIs('aluno.tecnico') ? 'active' : '' }}">
                      <span class="material-symbols-rounded">Code</span>
                      <span class="menu-label">Codificação</span>
                  </a>
              </li>
              <li class="menu-item">
                  <a href="{{ route('aluno.noticias-tech') }}" class="menu-link {{ request()->routeIs('aluno.noticias-tech') ? 'active' : '' }}">
                      <span class="material-symbols-rounded">news</span>
                      <span class="menu-label">Noticias Tech</span>
                  </a>
              </li>

              <li class="menu-item">
                  <a href="{{ route('aluno.curriculo.form') }}" class="menu-link {{ request()->routeIs('aluno.curriculo.form') ? 'active' : '' }}">
                      <span class="material-symbols-rounded">article_person</span>
                      <span class="menu-label">Currículo com IA</span>
                  </a>
              </li>

              <li class="menu-item">
                  <a href="{{ route('aluno.configuracoes-aluno') }}" class="menu-link  {{ request()->routeIs('aluno.configuracoes-aluno') ? 'active' : '' }}">
                      <span class="material-symbols-rounded">Settings</span>
                      <span class="menu-label"> Configurações </span>
                  </a>
              </li>


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
      </div>
  </aside>
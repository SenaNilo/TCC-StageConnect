document.addEventListener('DOMContentLoaded', () => {

  // === LÓGICA PARA MOSTRAR/ESCONDER SENHA ===
  const passwordToggles = document.querySelectorAll('.password-toggle-icon');

  passwordToggles.forEach(toggle => {
    toggle.addEventListener('click', () => {
      // Encontra o input de senha irmão ou dentro do mesmo wrapper
      const wrapper = toggle.closest('.password-input-wrapper'); // Se usar o wrapper CSS
      // Ou, se não usar wrapper: const input = toggle.previousElementSibling.querySelector('input[type="password"], input[type="text"]');
      const input = wrapper ? wrapper.querySelector('input[type="password"], input[type="text"]') : null;

      if (input) {
        // Verifica o tipo atual e troca
        if (input.type === 'password') {
          input.type = 'text';
          toggle.textContent = 'visibility_off'; // Muda o ícone para olho fechado
        } else {
          input.type = 'password';
          toggle.textContent = 'visibility'; // Muda o ícone para olho aberto
        }
      }
    });
  });
});


const sidebarToggleBtns = document.querySelectorAll(".sidebar-toggle");
const sidebar = document.querySelector(".sidebar");
const searchForm = document.querySelector(".search-form");
const themeToggleBtn = document.querySelector(".theme-toggle");
const themeIcon = themeToggleBtn.querySelector(".theme-icon");
const menuLinks = document.querySelectorAll(".menu-link");

const updateThemeIcon = () => {
  const isDark = document.body.classList.contains("dark-theme");
  themeIcon.textContent = sidebar.classList.contains("collapsed") ? (isDark ? "light_mode" : "dark_mode") : "dark_mode";
};

const savedTheme = localStorage.getItem("theme");
const systemPrefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
const shouldUseDarkTheme = savedTheme === "dark" || (!savedTheme && systemPrefersDark);
document.body.classList.toggle("dark-theme", shouldUseDarkTheme);

themeToggleBtn.addEventListener("click", () => {
  const isDark = document.body.classList.toggle("dark-theme");
  localStorage.setItem("theme", isDark ? "dark" : "light");
});

sidebarToggleBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    sidebar.classList.toggle("collapsed");
  });
});

searchForm.addEventListener("click", () => {
  if (sidebar.classList.contains("collapsed")) {
    sidebar.classList.remove("collapsed");
    searchForm.querySelector("input").focus();
  }
});

if (window.innerWidth > 768) sidebar.classList.remove("collapsed");

// Lógica para o Toggle de Tema
const changeThemeBtn = document.querySelector("#change-theme");

function toggleLightMode() {
    document.body.classList.toggle("light");
}

function loadTheme() {
    const lightMode = localStorage.getItem("light");
    if(lightMode) {
        toggleLightMode();
    }
}

if(changeThemeBtn) {
    loadTheme();

    changeThemeBtn.addEventListener("change", function() {
        toggleLightMode();
        localStorage.removeItem("light");
        if (document.body.classList.contains("light")) {
            localStorage.setItem("light", 1);
        }
    });
}
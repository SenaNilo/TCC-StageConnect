// Seleciona os elementos que vamos usar
const openModalBtn = document.getElementById('open-modal-btn');
const logoutModal = document.getElementById('logout-modal');
const cancelLogoutBtn = document.getElementById('cancel-logout-btn');
const confirmLogoutBtn = document.getElementById('confirm-logout-btn');
const logoutForm = document.getElementById('logout-form');

// Quando o usuário clicar no botão "Sair" da sidebar
openModalBtn.addEventListener('click', () => {
    logoutModal.classList.remove('modal-hidden'); // Mostra o modal
});

// Quando o usuário clicar em "Cancelar"
cancelLogoutBtn.addEventListener('click', () => {
    logoutModal.classList.add('modal-hidden'); // Esconde o modal
});

// Quando o usuário clicar no fundo escuro (overlay)
logoutModal.addEventListener('click', (event) => {
    // Se o clique foi no overlay (fundo) e não no card
    if (event.target === logoutModal) {
        logoutModal.classList.add('modal-hidden'); // Esconde o modal
    }
});

// Quando o usuário clicar em "Confirmar"
confirmLogoutBtn.addEventListener('click', () => {
    logoutForm.submit(); // Envia o formulário de logout!
});
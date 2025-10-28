
        document.addEventListener('DOMContentLoaded', () => {
            // --- Lógica do Modal de Sucesso (COM TIMER) ---
            const successModal = document.getElementById('success-modal');
            if (!successModal) return;

            const closeBtn = document.getElementById('success-modal-close-btn');
            const successMessageEl = document.getElementById('success-modal-message');
            const progressBar = document.getElementById('success-modal-progress'); // Pega a barra
            let timer; // Variável para guardar o timer

            // Função para mostrar o modal
            function showSuccessModal(message) {
                successMessageEl.textContent = message;
                successModal.classList.remove('modal-hidden');

                // === LÓGICA DO TIMER RE-ADICIONADA ===
                // Reinicia a animação da barra
                progressBar.style.animation = 'none';
                void progressBar.offsetWidth; // Força o reinício
                progressBar.style.animation = 'progress-timer 5s linear forwards';

                // Define o timer para fechar o modal
                timer = setTimeout(hideSuccessModal, 5000);
                // ===================================
            }

            // Função para esconder o modal
            function hideSuccessModal() {
                // === LÓGICA DO TIMER RE-ADICIONADA ===
                clearTimeout(timer); // Limpa o timer se fechar manualmente
                // ===================================
                successModal.classList.add('modal-hidden');
            }

            // Evento do botão de fechar (X)
            closeBtn.addEventListener('click', hideSuccessModal);

            // Evento de clicar no fundo (overlay) para fechar
            successModal.addEventListener('click', (event) => {
                if (event.target === successModal) {
                    hideSuccessModal();
                }
            });

            // --- Gatilho JavaScript Puro (lendo o <body>) ---
            const successMessage = document.body.dataset.successMessage;
            if (successMessage) {
                showSuccessModal(successMessage);
            }
        });


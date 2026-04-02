export function initializeConfirmations() {
    document.querySelectorAll('form[data-confirm]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            const message = form.dataset.confirm || '¿Estás seguro?';

            if (!window.confirm(message)) {
                event.preventDefault();
            }
        });
    });
}

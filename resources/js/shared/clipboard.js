export function initializeClipboard() {
    document.querySelectorAll('[data-copy-text]').forEach((trigger) => {
        trigger.addEventListener('click', async () => {
            const value = trigger.dataset.copyText;

            if (!value || !navigator.clipboard) {
                return;
            }

            try {
                await navigator.clipboard.writeText(value);
            } catch (error) {
                console.error('No se pudo copiar al portapapeles.', error);
            }
        });
    });
}

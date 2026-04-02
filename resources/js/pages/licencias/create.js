export function initializeLicenciaCreatePage() {
    const tipoSelect = document.querySelector('[data-license-type-toggle]');
    const duracionContainer = document.querySelector('[data-duration-container]');

    if (!tipoSelect || !duracionContainer) {
        return;
    }

    const updateVisibility = () => {
        duracionContainer.style.display = tipoSelect.value === 'compra' ? 'none' : 'block';
    };

    tipoSelect.addEventListener('change', updateVisibility);
    updateVisibility();
}

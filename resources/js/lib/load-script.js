const scriptRegistry = new Map();

export function loadScript(src) {
    if (scriptRegistry.has(src)) {
        return scriptRegistry.get(src);
    }

    const promise = new Promise((resolve, reject) => {
        const existingScript = document.querySelector(`script[src="${src}"]`);

        if (existingScript) {
            if (existingScript.dataset.loaded === 'true') {
                resolve();
                return;
            }

            existingScript.addEventListener('load', () => resolve(), { once: true });
            existingScript.addEventListener('error', () => reject(new Error(`No se pudo cargar ${src}`)), { once: true });
            return;
        }

        const script = document.createElement('script');
        script.src = src;
        script.async = true;
        script.addEventListener('load', () => {
            script.dataset.loaded = 'true';
            resolve();
        }, { once: true });
        script.addEventListener('error', () => reject(new Error(`No se pudo cargar ${src}`)), { once: true });
        document.head.appendChild(script);
    });

    scriptRegistry.set(src, promise);
    return promise;
}

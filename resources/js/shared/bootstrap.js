import { loadScript } from '../lib/load-script';

export function ensureBootstrap() {
    return loadScript('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js');
}

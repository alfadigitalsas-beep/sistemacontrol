import './bootstrap';

import { ensureBootstrap } from './shared/bootstrap';
import { initializeClipboard } from './shared/clipboard';
import { initializeConfirmations } from './shared/confirmations';
import { initializeDashboardPage } from './pages/dashboard/index';
import { initializeLicenciaCreatePage } from './pages/licencias/create';
import { initializeReportesPage } from './pages/reportes/index';

async function initializeApplication() {
    await ensureBootstrap();
    initializeConfirmations();
    initializeClipboard();
    initializeLicenciaCreatePage();
    await initializeDashboardPage();
    await initializeReportesPage();
}

initializeApplication().catch((error) => {
    console.error('Error inicializando la aplicación.', error);
});

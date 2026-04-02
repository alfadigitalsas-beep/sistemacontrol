import { loadScript } from '../lib/load-script';

export async function ensureChartJs() {
    await loadScript('https://cdn.jsdelivr.net/npm/chart.js');
    return window.Chart;
}

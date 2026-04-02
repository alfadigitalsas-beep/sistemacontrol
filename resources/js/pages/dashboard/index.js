import { ensureChartJs } from '../../shared/chart-loader';

function parseJsonAttribute(element, attributeName) {
    const value = element.dataset[attributeName];
    return value ? JSON.parse(value) : [];
}

function buildCommonOptions(overrides = {}) {
    return {
        responsive: true,
        maintainAspectRatio: false,
        ...overrides,
    };
}

export async function initializeDashboardPage() {
    const ingresosChartElement = document.getElementById('ingresosChart');

    if (!ingresosChartElement) {
        return;
    }

    const Chart = await ensureChartJs();

    new Chart(ingresosChartElement.getContext('2d'), {
        type: 'bar',
        data: {
            labels: parseJsonAttribute(ingresosChartElement, 'labels'),
            datasets: [{
                label: 'Ingresos',
                data: parseJsonAttribute(ingresosChartElement, 'values'),
                backgroundColor: '#3b82f6',
                borderRadius: 4,
            }],
        },
        options: buildCommonOptions({
            plugins: {
                legend: { display: false },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback(value) {
                            return `$${value}M`;
                        },
                    },
                },
            },
        }),
    });

    const licenciasChartElement = document.getElementById('licenciasChart');

    if (licenciasChartElement) {
        new Chart(licenciasChartElement.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: parseJsonAttribute(licenciasChartElement, 'labels'),
                datasets: [{
                    data: parseJsonAttribute(licenciasChartElement, 'values'),
                    backgroundColor: ['#3b82f6', '#10b981'],
                }],
            },
            options: buildCommonOptions({
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                },
            }),
        });
    }

    const productosChartElement = document.getElementById('productosChart');

    if (productosChartElement) {
        new Chart(productosChartElement.getContext('2d'), {
            type: 'bar',
            data: {
                labels: parseJsonAttribute(productosChartElement, 'labels'),
                datasets: [{
                    label: 'Licencias vendidas',
                    data: parseJsonAttribute(productosChartElement, 'values'),
                    backgroundColor: '#8b5cf6',
                    borderRadius: 4,
                }],
            },
            options: buildCommonOptions({
                indexAxis: 'y',
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    x: {
                        beginAtZero: true,
                    },
                },
            }),
        });
    }
}

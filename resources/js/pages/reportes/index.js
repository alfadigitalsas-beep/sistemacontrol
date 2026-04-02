import { ensureChartJs } from '../../shared/chart-loader';

function parseJsonAttribute(element, attributeName) {
    const value = element.dataset[attributeName];
    return value ? JSON.parse(value) : [];
}

export async function initializeReportesPage() {
    const ingresosChartElement = document.getElementById('ingresosMensualesChart');

    if (!ingresosChartElement) {
        return;
    }

    const Chart = await ensureChartJs();

    new Chart(ingresosChartElement.getContext('2d'), {
        type: 'line',
        data: {
            labels: parseJsonAttribute(ingresosChartElement, 'labels'),
            datasets: [{
                label: 'Ingresos',
                data: parseJsonAttribute(ingresosChartElement, 'values'),
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                fill: true,
                tension: 0.4,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
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
        },
    });

    const distribucionChartElement = document.getElementById('distribucionChart');

    if (distribucionChartElement) {
        new Chart(distribucionChartElement.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: parseJsonAttribute(distribucionChartElement, 'labels'),
                datasets: [{
                    data: parseJsonAttribute(distribucionChartElement, 'values'),
                    backgroundColor: ['#3b82f6', '#10b981', '#f59e0b'],
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label(context) {
                                return `$${context.raw.toLocaleString('es-CO')}`;
                            },
                        },
                    },
                },
            },
        });
    }

    const topClientesChartElement = document.getElementById('topClientesChart');

    if (topClientesChartElement) {
        new Chart(topClientesChartElement.getContext('2d'), {
            type: 'bar',
            data: {
                labels: parseJsonAttribute(topClientesChartElement, 'labels'),
                datasets: [{
                    label: 'Total Gastado',
                    data: parseJsonAttribute(topClientesChartElement, 'values'),
                    backgroundColor: '#8b5cf6',
                    borderRadius: 4,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            callback(value) {
                                return `$${(value / 1000000).toFixed(1)}M`;
                            },
                        },
                    },
                },
            },
        });
    }
}

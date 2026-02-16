@extends('layouts.app')

@section('title', 'Reportes Financieros')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Reportes Financieros</h4>
        <p class="text-muted mb-0">Análisis detallado de ingresos y transacciones</p>
    </div>
    <div class="d-flex gap-2">
        <form action="{{ route('reportes.index') }}" method="GET" class="d-flex gap-2">
            <select name="anio" class="form-select" style="width: auto;">
                @foreach($aniosDisponibles as $anio)
                    <option value="{{ $anio }}" {{ $anioSeleccionado == $anio ? 'selected' : '' }}>{{ $anio }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-outline-primary">
                <i class="bi bi-filter"></i>
            </button>
        </form>
        <a href="{{ route('reportes.exportar', ['anio' => $anioSeleccionado]) }}" class="btn btn-outline-success">
            <i class="bi bi-download me-2"></i>Exportar CSV
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Total Ingresos</span>
                <div class="stat-icon primary">
                    <i class="bi bi-cash-stack"></i>
                </div>
            </div>
            <div class="stat-value">${{ number_format($stats['total_ingresos'], 0, ',', '.') }}</div>
            <div class="stat-label">{{ $stats['cantidad_transacciones'] }} transacciones</div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="stat-card success">
            <div class="stat-header">
                <span class="stat-title">Ventas</span>
                <div class="stat-icon success">
                    <i class="bi bi-graph-up"></i>
                </div>
            </div>
            <div class="stat-value">${{ number_format($stats['total_ventas'], 0, ',', '.') }}</div>
            <div class="stat-label">{{ $stats['total_ingresos'] > 0 ? round(($stats['total_ventas'] / $stats['total_ingresos']) * 100) : 0 }}% del total</div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="stat-card warning">
            <div class="stat-header">
                <span class="stat-title">Alquileres</span>
                <div class="stat-icon warning">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
            </div>
            <div class="stat-value">${{ number_format($stats['total_alquileres'], 0, ',', '.') }}</div>
            <div class="stat-label">{{ $stats['total_ingresos'] > 0 ? round(($stats['total_alquileres'] / $stats['total_ingresos']) * 100) : 0 }}% del total</div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="stat-card" style="border-left-color: #8b5cf6;">
            <div class="stat-header">
                <span class="stat-title">Promedio</span>
                <div class="stat-icon" style="background: #ede9fe; color: #8b5cf6;">
                    <i class="bi bi-bar-chart"></i>
                </div>
            </div>
            <div class="stat-value">${{ number_format($stats['promedio_transaccion'], 0, ',', '.') }}</div>
            <div class="stat-label">Por transacción</div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Ingresos Mensuales -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-graph-up text-primary me-2"></i>
                    Ingresos Mensuales {{ $anioSeleccionado }}
                </h5>
            </div>
            <div class="card-body">
                <canvas id="ingresosMensualesChart" height="280"></canvas>
            </div>
        </div>
    </div>

    <!-- Distribución por Tipo -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-pie-chart text-success me-2"></i>
                    Distribución por Tipo
                </h5>
            </div>
            <div class="card-body">
                <canvas id="distribucionChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Top Clientes -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-trophy text-warning me-2"></i>
                    Top Clientes por Gasto
                </h5>
            </div>
            <div class="card-body">
                <canvas id="topClientesChart" height="250"></canvas>
            </div>
        </div>
    </div>

    <!-- Top Productos -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-box text-primary me-2"></i>
                    Top Productos por Ingresos
                </h5>
            </div>
            <div class="card-body">
                @foreach($topProductos as $index => $producto)
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            @if($index == 0)
                                <span class="badge bg-warning text-dark fs-6">1</span>
                            @elseif($index == 1)
                                <span class="badge bg-secondary fs-6">2</span>
                            @elseif($index == 2)
                                <span class="badge bg-danger fs-6">3</span>
                            @else
                                <span class="badge bg-light text-dark fs-6">{{ $index + 1 }}</span>
                            @endif
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">{{ $producto->nombre }}</h6>
                        </div>
                        <div class="text-end">
                            <strong>${{ number_format($producto->licencias_sum_precio_total ?? 0, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Transacciones Recientes -->
<div class="card">
    <div class="card-header">
        <h5 class="card-title">
            <i class="bi bi-file-text text-primary me-2"></i>
            Transacciones Recientes
        </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaccionesRecientes as $transaccion)
                        <tr>
                            <td>{{ $transaccion->fecha->format('d M Y') }}</td>
                            <td>{{ $transaccion->cliente->nombre }}</td>
                            <td>
                                <span class="badge bg-{{ $transaccion->tipo == 'venta' ? 'primary' : ($transaccion->tipo == 'alquiler' ? 'success' : 'warning') }}">
                                    {{ $transaccion->tipo_label }}
                                </span>
                            </td>
                            <td class="text-success fw-bold">+${{ number_format($transaccion->monto, 0, ',', '.') }}</td>
                            <td>{{ $transaccion->descripcion }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Ingresos Mensuales
    const ingresosCtx = document.getElementById('ingresosMensualesChart').getContext('2d');
    new Chart(ingresosCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_column($ingresosPorMes, 'mes')) !!},
            datasets: [{
                label: 'Ingresos',
                data: {!! json_encode(array_column($ingresosPorMes, 'monto')) !!},
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value + 'M';
                        }
                    }
                }
            }
        }
    });

    // Distribución por Tipo
    const distribucionCtx = document.getElementById('distribucionChart').getContext('2d');
    new Chart(distribucionCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_column($ingresosPorTipo, 'name')) !!},
            datasets: [{
                data: {!! json_encode(array_column($ingresosPorTipo, 'value')) !!},
                backgroundColor: ['#3b82f6', '#10b981', '#f59e0b']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const value = context.raw;
                            return '$' + value.toLocaleString('es-CO');
                        }
                    }
                }
            }
        }
    });

    // Top Clientes
    const topClientesCtx = document.getElementById('topClientesChart').getContext('2d');
    new Chart(topClientesCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($topClientes->pluck('nombre')->map(fn($n) => explode(' ', $n)[0])->toArray()) !!},
            datasets: [{
                label: 'Total Gastado',
                data: {!! json_encode($topClientes->pluck('transacciones_sum_monto')->toArray()) !!},
                backgroundColor: '#8b5cf6',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + (value / 1000000).toFixed(1) + 'M';
                        }
                    }
                }
            }
        }
    });
</script>
@endpush

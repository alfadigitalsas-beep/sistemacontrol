@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <!-- Stats Cards -->
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Total Clientes</span>
                <div class="stat-icon primary">
                    <i class="bi bi-people"></i>
                </div>
            </div>
            <div class="stat-value">{{ number_format($stats['total_clientes']) }}</div>
            <div class="stat-label">Clientes activos registrados</div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="stat-card success">
            <div class="stat-header">
                <span class="stat-title">Licencias Activas</span>
                <div class="stat-icon success">
                    <i class="bi bi-key"></i>
                </div>
            </div>
            <div class="stat-value">{{ number_format($stats['licencias_activas']) }}</div>
            <div class="stat-label">
                @if($stats['licencias_por_vencer'] > 0)
                    <span class="text-warning fw-bold">{{ $stats['licencias_por_vencer'] }} por vencer</span>
                @else
                    Todas al día
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Ingresos del Mes</span>
                <div class="stat-icon primary">
                    <i class="bi bi-graph-up"></i>
                </div>
            </div>
            <div class="stat-value">${{ number_format($stats['ingresos_mes'], 0, ',', '.') }}</div>
            <div class="stat-label">Total acumulado este mes</div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="stat-card warning">
            <div class="stat-header">
                <span class="stat-title">Ingresos del Año</span>
                <div class="stat-icon warning">
                    <i class="bi bi-cart"></i>
                </div>
            </div>
            <div class="stat-value">${{ number_format($stats['ingresos_anio'], 0, ',', '.') }}</div>
            <div class="stat-label">Total acumulado {{ date('Y') }}</div>
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
                    Ingresos Mensuales
                </h5>
            </div>
            <div class="card-body">
                <canvas id="ingresosChart" height="280"></canvas>
            </div>
        </div>
    </div>

    <!-- Distribución de Licencias -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-pie-chart text-success me-2"></i>
                    Distribución de Licencias
                </h5>
            </div>
            <div class="card-body">
                <canvas id="licenciasChart" height="200"></canvas>
                <div class="row mt-4 text-center">
                    <div class="col-6">
                        <h4 class="text-primary mb-0">{{ $stats['compras_totales'] }}</h4>
                        <small class="text-muted">Compras</small>
                    </div>
                    <div class="col-6">
                        <h4 class="text-success mb-0">{{ $stats['alquileres_activos'] }}</h4>
                        <small class="text-muted">Alquileres</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Productos Más Vendidos -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-box text-primary me-2"></i>
                    Productos Más Vendidos
                </h5>
            </div>
            <div class="card-body">
                <canvas id="productosChart" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Top Clientes -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-trophy text-warning me-2"></i>
                    Top Clientes
                </h5>
            </div>
            <div class="card-body">
                @foreach($clientesTop as $index => $cliente)
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
                            <h6 class="mb-0">{{ $cliente->nombre }}</h6>
                            <small class="text-muted">{{ $cliente->empresa }}</small>
                        </div>
                        <div class="text-end">
                            <strong>${{ number_format($cliente->transacciones_sum_monto ?? 0, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-2">
    <!-- Licencias Recientes -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-key text-primary me-2"></i>
                    Licencias Recientes
                </h5>
            </div>
            <div class="card-body">
                @foreach($licenciasRecientes as $licencia)
                    <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded mb-2">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                <i class="bi bi-key text-primary"></i>
                            </div>
                            <div>
                                <code class="d-block">{{ $licencia->clave_licencia }}</code>
                                <small class="text-muted">{{ $licencia->fecha_creacion->format('d M Y') }}</small>
                            </div>
                        </div>
                        <span class="badge badge-{{ $licencia->tipo }}">
                            {{ $licencia->tipo_label }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Transacciones Recientes -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-cash-stack text-success me-2"></i>
                    Transacciones Recientes
                </h5>
            </div>
            <div class="card-body">
                @foreach($transaccionesRecientes as $transaccion)
                    <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded mb-2">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                <i class="bi bi-graph-up text-success"></i>
                            </div>
                            <div>
                                <p class="mb-0 fw-medium">{{ $transaccion->descripcion }}</p>
                                <small class="text-muted">{{ $transaccion->fecha->format('d M Y') }}</small>
                            </div>
                        </div>
                        <span class="text-success fw-bold">
                            +${{ number_format($transaccion->monto, 0, ',', '.') }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Ingresos Mensuales
    const ingresosCtx = document.getElementById('ingresosChart').getContext('2d');
    new Chart(ingresosCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_column($ingresosPorMes, 'mes')) !!},
            datasets: [{
                label: 'Ingresos',
                data: {!! json_encode(array_column($ingresosPorMes, 'monto')) !!},
                backgroundColor: '#3b82f6',
                borderRadius: 4
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

    // Distribución de Licencias
    const licenciasCtx = document.getElementById('licenciasChart').getContext('2d');
    new Chart(licenciasCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_column($licenciasPorTipo, 'name')) !!},
            datasets: [{
                data: {!! json_encode(array_column($licenciasPorTipo, 'value')) !!},
                backgroundColor: ['#3b82f6', '#10b981']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Productos Más Vendidos
    const productosCtx = document.getElementById('productosChart').getContext('2d');
    new Chart(productosCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($productosMasVendidos->pluck('nombre')->toArray()) !!},
            datasets: [{
                label: 'Licencias vendidas',
                data: {!! json_encode($productosMasVendidos->pluck('licencias_count')->toArray()) !!},
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
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush

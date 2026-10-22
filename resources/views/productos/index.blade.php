@extends('layouts.app')

@section('title', 'Productos')

@section('content')
<style>
    .products-page .products-hero { gap: 1.25rem; }
    .products-page .products-subtitle { max-width: 38rem; }
    .products-page .filter-card { border: 1px solid #e8eef6; }
    .products-page .filter-card .input-group-text { background: #f8fafc; border-color: #e2e8f0; color: #64748b; }
    .products-page .category-card { border: 1px solid #edf2f7; transition: transform .2s ease, box-shadow .2s ease; }
    .products-page .category-card:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(15, 23, 42, .08); }
    .products-page .category-icon { width: 48px; height: 48px; display: grid; place-items: center; background: #f1f5f9; border-radius: 12px; font-size: 1.5rem; }
    .products-page .category-total { font-size: 1.25rem; font-weight: 700; color: #0f172a; line-height: 1; }
    .products-page .product-card { border: 1px solid #e8eef6; overflow: hidden; transition: transform .2s ease, box-shadow .2s ease; }
    .products-page .product-card:hover { transform: translateY(-4px); box-shadow: 0 14px 28px rgba(15, 23, 42, .1); }
    .products-page .product-icon { width: 58px; height: 58px; display: grid; place-items: center; flex: 0 0 auto; border-radius: 14px; background: linear-gradient(135deg, #eff6ff, #eef2ff); font-size: 1.8rem; }
    .products-page .product-name { color: #0f172a; font-size: 1rem; font-weight: 700; }
    .products-page .product-description { min-height: 3rem; color: #64748b; font-size: .9rem; line-height: 1.5; }
    .products-page .product-card .row.g-2 > .col-4 > div { height: 100%; padding: .75rem .35rem !important; border-radius: 10px; background: #f8fafc !important; }
    .products-page .product-card .row.g-2 small { color: #64748b !important; font-size: .72rem; }
    .products-page .product-card .row.g-2 strong { color: #0f172a; font-size: .85rem; white-space: nowrap; }
    .products-page .price-box { padding: .75rem .35rem; border-radius: 10px; background: #f8fafc; }
    .products-page .price-label { color: #64748b; font-size: .72rem; }
    .products-page .price-value { color: #0f172a; font-size: .85rem; font-weight: 700; white-space: nowrap; }
    @media (max-width: 575.98px) { .products-page .products-hero .btn { width: 100%; } .products-page .product-description { min-height: auto; } }
</style>
<div class="products-page">
<div class="products-hero d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
    <div>
        <h4 class="mb-1">Gestion de Productos</h4>
        <p class="text-muted mb-0">Administra el catalogo de software disponible</p>
    </div>
    <a href="{{ route('productos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Nuevo Producto
    </a>
</div>

<!-- Filtros -->
<div class="filter-card card mb-4">
    <div class="card-body">
        <form action="{{ route('productos.index') }}" method="GET" class="row g-3">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" name="busqueda" class="form-control" placeholder="Buscar por nombre, descripcion o version..." value="{{ request('busqueda') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="categoria" class="form-select">
                    <option value="todas">Todas las categorias</option>
                    @foreach($categorias as $key => $label)
                        <option value="{{ $key }}" {{ request('categoria') == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1 d-grid">
                <button type="submit" class="btn btn-primary" title="Aplicar filtros">
                    <i class="bi bi-funnel me-md-0 me-2"></i><span class="d-md-none">Filtrar</span>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="row g-4 mb-4">
    @foreach($categorias as $key => $label)
        <div class="col-6 col-md-4 col-xl-2">
            <div class="category-card card h-100">
                <div class="card-body d-flex align-items-center">
                    <span class="category-icon me-3">{{ $iconos[$key] }}</span>
                    <div>
                        <div class="category-total">{{ $productosPorCategoria[$key] ?? 0 }}</div>
                        <small class="text-muted">{{ $label }}</small>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row g-4">
    @forelse($productos as $producto)
        <div class="col-md-6 col-xl-4">
            <div class="product-card card h-100 {{ !$producto->activo ? 'opacity-50' : '' }}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex align-items-center">
                            <div class="product-icon me-3">
                                {{ $producto->icono }}
                            </div>
                            <div>
                                <h6 class="product-name mb-1">{{ $producto->nombre }}</h6>
                                <small class="text-muted">v{{ $producto->version }}</small>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('productos.edit', $producto) }}"><i class="bi bi-pencil me-2"></i>Editar</a></li>
                                <li>
                                    <form action="{{ route('productos.toggle-activo', $producto) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-{{ $producto->activo ? 'pause-circle' : 'play-circle' }} me-2"></i>
                                            {{ $producto->activo ? 'Desactivar' : 'Activar' }}
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="d-inline" data-confirm="Estas seguro de eliminar este producto?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger"><i class="bi bi-trash me-2"></i>Eliminar</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <p class="text-muted mb-3 producto-descripcion">{{ Str::limit($producto->descripcion, 100) }}</p>

                    <div class="row g-2 mb-3">
                        <div class="col-4 text-center p-2 bg-light rounded">
                            <small class="text-muted d-block">Compra</small>
                            <strong class="d-block">{{ $producto->getPrecioFormateado('compra') }}</strong>
                        </div>
                        <div class="col-4 text-center p-2 bg-light rounded">
                            <small class="text-muted d-block">Mensual</small>
                            <strong class="d-block">{{ $producto->getPrecioFormateado('mensual') }}</strong>
                        </div>
                        <div class="col-4 text-center p-2 bg-light rounded">
                            <small class="text-muted d-block">Anual</small>
                            <strong class="d-block">{{ $producto->getPrecioFormateado('anual') }}</strong>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <span class="badge bg-{{ $producto->categoria == 'ofimatica' ? 'primary' : ($producto->categoria == 'diseno' ? 'danger' : ($producto->categoria == 'desarrollo' ? 'success' : ($producto->categoria == 'seguridad' ? 'warning' : ($producto->categoria == 'contabilidad' ? 'info' : 'secondary')))) }}">
                            {{ $producto->categoria_label }}
                        </span>
                        <div class="text-end">
                            <small class="text-muted d-block">Licencias</small>
                            <strong>{{ $producto->licencias_count }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="bi bi-box display-1 text-muted"></i>
                <h5 class="mt-3 text-muted">No se encontraron productos</h5>
                <p class="text-muted">Intenta ajustar los filtros o agrega un nuevo producto</p>
            </div>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $productos->links() }}
</div>
</div>
@endsection

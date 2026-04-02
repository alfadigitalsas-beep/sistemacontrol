<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Alfa Digital Solutions</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="app-shell page-{{ str_replace('.', '-', request()->route()?->getName() ?? 'app') }}">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="brand">
                <div class="brand-logo">A</div>
                <div class="brand-text">
                    <h1>Alfa Digital</h1>
                    <p>Solutions</p>
                </div>
            </div>
        </div>

        <nav class="nav-menu">
            <div class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('clientes.index') }}" class="nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Clientes</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('productos.index') }}" class="nav-link {{ request()->routeIs('productos.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam-fill"></i>
                    <span>Productos</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('licencias.index') }}" class="nav-link {{ request()->routeIs('licencias.*') ? 'active' : '' }}">
                    <i class="bi bi-key-fill"></i>
                    <span>Licencias</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('uso.index') }}" class="nav-link {{ request()->routeIs('uso.*') ? 'active' : '' }}">
                    <i class="bi bi-activity"></i>
                    <span>Seguimiento de Uso</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('reportes.index') }}" class="nav-link {{ request()->routeIs('reportes.*') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart-fill"></i>
                    <span>Reportes</span>
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="header">
            <div class="header-title">
                <h2>@yield('title', 'Dashboard')</h2>
            </div>
            <div class="header-actions">
                <button class="btn-notification">
                    <i class="bi bi-bell"></i>
                    <span class="badge">3</span>
                </button>
                <div class="user-profile">
                    <div class="user-info">
                        <p>Administrador</p>
                        <span>admin@alfadigital.com</span>
                    </div>
                    <div class="user-avatar">AD</div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; {{ date('Y') }} Alfa Digital Solutions SAS. Todos los derechos reservados.</p>
        </footer>
    </main>
</body>
</html>

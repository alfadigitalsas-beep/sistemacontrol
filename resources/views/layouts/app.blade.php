<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Alfa Digital Solutions</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-collapsed: 70px;
            --primary-color: #3b82f6;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8fafc;
            overflow-x: hidden;
        }

        /* SweetAlert2: apariencia coherente con Alfa Digital */
        .swal2-popup.alfa-swal {
            border-radius: 18px;
            padding: 2rem;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .alfa-swal .swal2-title {
            color: #1e293b;
            font-size: 1.4rem;
            font-weight: 700;
        }

        .alfa-swal .swal2-html-container {
            color: #64748b;
        }

        .alfa-swal .swal2-confirm,
        .alfa-swal .swal2-cancel {
            border-radius: 8px;
            box-shadow: none !important;
            font-weight: 600;
            padding: .65rem 1.25rem;
        }

        .alfa-swal .swal2-confirm {
            background-color: #3b82f6;
        }

        .alfa-swal .swal2-cancel {
            background-color: #e2e8f0;
            color: #475569;
        }

        .alfa-toast {
            border-radius: 12px !important;
            box-shadow: 0 12px 28px rgba(15, 23, 42, .16) !important;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            color: #fff;
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .brand-text h1 {
            font-size: 1rem;
            font-weight: 600;
            margin: 0;
        }

        .brand-text p {
            font-size: 0.75rem;
            color: #94a3b8;
            margin: 0;
        }

        .nav-menu {
            padding: 1rem 0;
        }

        .nav-item {
            margin: 0.25rem 0.75rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(59, 130, 246, 0.15);
            color: #fff;
        }

        .nav-link i {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        .nav-link span {
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* Header */
        .header {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-title h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn-notification {
            position: relative;
            background: none;
            border: none;
            padding: 0.5rem;
            color: #64748b;
            font-size: 1.25rem;
            cursor: pointer;
        }

        .btn-notification .badge {
            position: absolute;
            top: 0;
            right: 0;
            background: #ef4444;
            color: #fff;
            font-size: 0.65rem;
            padding: 0.15rem 0.4rem;
            border-radius: 10px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-info {
            text-align: right;
        }

        .user-info p {
            margin: 0;
            font-size: 0.85rem;
            font-weight: 500;
            color: #1e293b;
        }

        .user-info span {
            font-size: 0.75rem;
            color: #64748b;
        }

        /* Content */
        .content {
            padding: 2rem;
        }

        /* Cards */
        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 1.5rem;
            border-left: 4px solid var(--primary-color);
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .stat-card.success { border-left-color: var(--success-color); }
        .stat-card.warning { border-left-color: var(--warning-color); }
        .stat-card.danger { border-left-color: var(--danger-color); }

        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .stat-title {
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 500;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .stat-icon.primary { background: #dbeafe; color: var(--primary-color); }
        .stat-icon.success { background: #d1fae5; color: var(--success-color); }
        .stat-icon.warning { background: #fef3c7; color: var(--warning-color); }
        .stat-icon.danger { background: #fee2e2; color: var(--danger-color); }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.8rem;
            color: #94a3b8;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.25rem;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        /* Tables */
        .table-container {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
        }

        .table {
            margin: 0;
        }

        .table th {
            background: #f8fafc;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            color: #64748b;
            padding: 1rem;
            border: none;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
            border-color: #f1f5f9;
        }

        /* Badges */
        .badge {
            padding: 0.4rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 500;
            border-radius: 20px;
        }

        .badge-compra { background: #dbeafe; color: #1d4ed8; }
        .badge-alquiler { background: #d1fae5; color: #047857; }
        .badge-activa { background: #d1fae5; color: #047857; }
        .badge-vencida { background: #fee2e2; color: #b91c1c; }
        .badge-suspendida { background: #fef3c7; color: #b45309; }

        /* Buttons */
        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background: #2563eb;
            border-color: #2563eb;
        }

        /* Forms */
        .form-control, .form-select {
            border-radius: 8px;
            border-color: #e2e8f0;
            padding: 0.625rem 0.875rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Pagination */
        .pagination {
            margin-bottom: 0;
        }

        .page-link {
            border: none;
            color: #64748b;
            padding: 0.5rem 0.875rem;
        }

        .page-item.active .page-link {
            background: var(--primary-color);
            color: #fff;
            border-radius: 6px;
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 10px;
            padding: 1rem 1.25rem;
        }

        /* Footer */
        .footer {
            padding: 1.5rem 2rem;
            text-align: center;
            color: #94a3b8;
            font-size: 0.85rem;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
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
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; {{ date('Y') }} Alfa Digital Solutions SAS. Todos los derechos reservados.</p>
        </footer>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                customClass: { popup: 'alfa-toast' },
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                },
            });

            @if(session('success'))
                Toast.fire({ icon: 'success', title: @json(session('success')) });
            @endif

            @if(session('error'))
                Toast.fire({ icon: 'error', title: @json(session('error')) });
            @endif

            @if($errors->any())
                const errors = @json($errors->all());
                const errorList = document.createElement('ul');
                errorList.className = 'text-start mb-0 ps-3';
                errors.forEach((error) => {
                    const item = document.createElement('li');
                    item.textContent = error;
                    errorList.appendChild(item);
                });

                Swal.fire({
                    icon: 'error',
                    title: 'Revisa la información',
                    html: errorList,
                    confirmButtonText: 'Entendido',
                    customClass: { popup: 'alfa-swal' },
                });
            @endif

            document.querySelectorAll('form').forEach((form) => {
                const method = form.querySelector('input[name="_method"]')?.value?.toUpperCase();

                if (method !== 'DELETE') return;

                // Sustituye cualquier confirmación nativa por el diálogo global.
                form.onsubmit = null;
                form.addEventListener('submit', (event) => {
                    event.preventDefault();

                    Swal.fire({
                        icon: 'warning',
                        title: '¿Eliminar registro?',
                        text: 'Esta acción no se puede deshacer.',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar',
                        reverseButtons: true,
                        focusCancel: true,
                        customClass: { popup: 'alfa-swal' },
                    }).then((result) => {
                        if (result.isConfirmed) form.submit();
                    });
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>

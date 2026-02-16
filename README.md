# Sistema de Gestión - Alfa Digital Solutions SAS

Sistema de gestión integral para la administración de licencias de software, clientes, productos y reportes financieros.

## 🚀 Requisitos

- PHP 8.2 o superior
- Composer
- MySQL 5.7 o superior / MariaDB 10.3 o superior
- Servidor web (Apache/Nginx)

## 📦 Instalación

### 1. Clonar o descargar el proyecto

```bash
cd alfa-digital-laravel
```

### 2. Instalar dependencias

```bash
composer install
```

### 3. Configurar el archivo de entorno

```bash
cp .env.example .env
php artisan key:generate
```

Edita el archivo `.env` y configura tu base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=alfa_digital
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 4. Crear la base de datos

```bash
mysql -u root -p -e "CREATE DATABASE alfa_digital CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 5. Ejecutar migraciones y seeders

```bash
php artisan migrate --seed
```

### 6. Iniciar el servidor de desarrollo

```bash
php artisan serve
```

Visita: http://localhost:8000

## 📁 Estructura del Proyecto

```
alfa-digital-laravel/
├── app/
│   ├── Http/
│   │   └── Controllers/      # Controladores MVC
│   │       ├── DashboardController.php
│   │       ├── ClienteController.php
│   │       ├── ProductoController.php
│   │       ├── LicenciaController.php
│   │       ├── ReporteController.php
│   │       └── UsoController.php
│   └── Models/               # Modelos Eloquent
│       ├── Cliente.php
│       ├── Producto.php
│       ├── Licencia.php
│       ├── Transaccion.php
│       └── RegistroUso.php
├── database/
│   ├── migrations/           # Migraciones de la BD
│   └── seeders/              # Datos de ejemplo
├── resources/
│   └── views/                # Vistas Blade
│       ├── layouts/
│       ├── dashboard/
│       ├── clientes/
│       ├── productos/
│       ├── licencias/
│       ├── reportes/
│       └── uso/
├── routes/
│   └── web.php               # Rutas de la aplicación
└── composer.json
```

## 🎯 Funcionalidades

### Dashboard
- Métricas clave en tiempo real
- Gráficos de ingresos mensuales
- Distribución de licencias
- Productos más vendidos
- Top clientes
- Actividad reciente

### Gestión de Clientes
- CRUD completo de clientes
- Clasificación por tipo (Comprador, Arrendatario, Ambos)
- Búsqueda y filtros avanzados
- Información de contacto completa

### Gestión de Productos
- Catálogo de software
- Categorías: Ofimática, Diseño, Desarrollo, Seguridad, Contabilidad
- Precios diferenciados (compra, alquiler mensual/anual)
- Activación/desactivación

### Control de Licencias
- Creación de licencias de compra o alquiler
- Generación automática de claves
- Control de vencimientos
- Renovación automática
- Estados: Activa, Vencida, Suspendida, Pendiente

### Reportes Financieros
- Ingresos por período
- Distribución por tipo de transacción
- Top clientes y productos
- Exportación a CSV

### Seguimiento de Uso
- Registro de actividad de usuarios
- Logins, logouts, activaciones
- Monitoreo por licencia
- Sesiones activas

## 🗄️ Modelos de Datos

### Cliente
- nombre, email, telefono, empresa
- tipo (comprador, arrendatario, ambos)
- direccion, ciudad, pais
- notas, activo, fecha_registro

### Producto
- nombre, descripcion, categoria
- version, precio_compra
- precio_alquiler_mensual, precio_alquiler_anual
- requisitos_sistema, activo, fecha_lanzamiento

### Licencia
- cliente_id, producto_id
- tipo (compra, alquiler)
- estado (activa, vencida, suspendida, pendiente)
- fecha_inicio, fecha_vencimiento
- cantidad_usuarios, clave_licencia
- precio_total, renovacion_automatica

### Transaccion
- cliente_id, licencia_id
- tipo (venta, alquiler, renovacion, reembolso)
- monto, fecha, metodo_pago, descripcion

### RegistroUso
- licencia_id, usuario_nombre, usuario_email
- dispositivo, ip_address
- fecha_acceso, accion, estado

## 🔐 Datos de Ejemplo

El sistema incluye datos de demostración:
- 5 clientes empresariales
- 5 productos de software
- 6 licencias activas
- 7 transacciones financieras
- Registros de uso

## 📊 Base de Datos

### Migraciones

Para crear las tablas:
```bash
php artisan migrate
```

Para hacer rollback:
```bash
php artisan migrate:rollback
```

### Seeders

Para llenar la base de datos con datos de ejemplo:
```bash
php artisan db:seed
```

## 🛠️ Comandos Útiles

```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Crear controlador
php artisan make:controller NombreController

# Crear modelo
php artisan make:model NombreModelo

# Crear migración
php artisan make:migration nombre_de_la_migracion

# Crear seeder
php artisan make:seeder NombreSeeder
```

## 📝 Licencia

Este proyecto es propiedad de Alfa Digital Solutions SAS.

## 👨‍💻 Desarrollado por

Alfa Digital Solutions SAS - 2024

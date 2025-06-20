<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Tierra Groove Admin

Panel de administración para el **Tierra Groove Festival**, desarrollado con Laravel 12. Este sistema permite gestionar toda la información del festival de manera dinámica y eficiente.

## 🎵 Sobre Tierra Groove Festival

Tierra Groove es un festival de música electrónica que se celebra en las impresionantes **Grutas de Tolantongo, Hidalgo**. El festival fusiona la música electrónica con la majestuosidad de la naturaleza, ofreciendo una experiencia única para los amantes de la música, la aventura y la comunidad.

**Sitio web oficial:** [https://tierragroove.com.mx/](https://tierragroove.com.mx/)

## 🚀 Características del Panel de Administración

### Gestión Completa del Festival
- **Información del Festival**: Fechas, ubicación, descripción, estado
- **Lineup de Artistas**: Gestión de artistas nacionales e internacionales
- **Escenarios**: Configuración de diferentes áreas del festival
- **Boletos**: Tipos de entrada, precios, disponibilidad
- **Galería**: Gestión de imágenes del evento
- **Cuenta Regresiva**: Fechas dinámicas para el evento

### Funcionalidades Técnicas
- Panel de administración moderno y responsive
- Gestión de archivos multimedia
- Sistema de autenticación seguro
- Dashboard con estadísticas en tiempo real
- Interfaz intuitiva con Tailwind CSS

## 📋 Requisitos del Sistema

- PHP 8.2 o superior
- Composer
- Node.js y NPM
- Base de datos (MySQL, PostgreSQL, SQLite)
- Servidor web (Apache, Nginx)

## 🛠️ Instalación

### 1. Clonar el Repositorio
```bash
git clone [URL_DEL_REPOSITORIO]
cd TierraGroove_admin
```

### 2. Instalar Dependencias
```bash
composer install
npm install
```

### 3. Configurar el Entorno
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar la Base de Datos
Editar el archivo `.env` con la configuración de tu base de datos:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tierragroove_admin
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

### 5. Ejecutar Migraciones y Seeders
```bash
php artisan migrate
php artisan db:seed
```

### 6. Configurar Almacenamiento
```bash
php artisan storage:link
```

### 7. Compilar Assets (Opcional)
```bash
npm run build
```

### 8. Iniciar el Servidor
```bash
php artisan serve
```

El panel de administración estará disponible en: `http://localhost:8000/admin`

## 👤 Acceso al Panel de Administración

### Crear un Usuario Administrador
```bash
php artisan tinker
```

```php
use App\Models\User;
User::create([
    'name' => 'Administrador',
    'email' => 'admin@tierragroove.com',
    'password' => bcrypt('tu_password_seguro')
]);
```

### Credenciales de Prueba
- **Email:** admin@tierragroove.com
- **Password:** password

## 📊 Estructura de la Base de Datos

### Tablas Principales

#### `festivals`
- Información principal del festival
- Fechas, ubicación, descripción
- Estado (activo, inactivo, borrador)
- Enlaces sociales

#### `artists`
- Lineup de artistas
- Información biográfica
- Género musical y país
- Orden de presentación

#### `stages`
- Escenarios del festival
- Capacidad y ubicación
- Descripción de cada área

#### `tickets`
- Tipos de boletos
- Precios y disponibilidad
- Beneficios incluidos
- Fechas de venta

#### `galleries`
- Imágenes del festival
- Categorización
- Orden de visualización

## 🎨 Personalización

### Modificar el Diseño
El panel utiliza Tailwind CSS. Para personalizar los estilos:

1. Editar `resources/css/app.css`
2. Ejecutar `npm run dev` para compilar cambios

### Agregar Nuevas Funcionalidades
1. Crear migraciones: `php artisan make:migration create_nueva_tabla`
2. Crear modelos: `php artisan make:model NuevoModelo`
3. Crear controladores: `php artisan make:controller Admin/NuevoController`
4. Crear vistas en `resources/views/admin/`

## 🔧 Comandos Útiles

```bash
# Ejecutar migraciones
php artisan migrate

# Revertir migraciones
php artisan migrate:rollback

# Ejecutar seeders
php artisan db:seed

# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Crear enlace simbólico para storage
php artisan storage:link

# Listar rutas
php artisan route:list
```

## 📁 Estructura del Proyecto

```
TierraGroove_admin/
├── app/
│   ├── Http/Controllers/Admin/     # Controladores del panel admin
│   └── Models/                     # Modelos de la aplicación
├── database/
│   ├── migrations/                 # Migraciones de la base de datos
│   └── seeders/                    # Datos de ejemplo
├── resources/
│   └── views/admin/                # Vistas del panel de administración
├── routes/
│   └── web.php                     # Rutas de la aplicación
└── storage/
    └── app/public/                 # Archivos subidos
```

## 🚀 Despliegue en Producción

### Configuración del Servidor
1. Configurar el servidor web (Apache/Nginx)
2. Establecer variables de entorno de producción
3. Configurar SSL/HTTPS
4. Optimizar la aplicación:

```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Variables de Entorno de Producción
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tu-dominio.com
```

## 🤝 Contribución

1. Fork el proyecto
2. Crear una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abrir un Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 📞 Soporte

Para soporte técnico o consultas sobre el panel de administración:

- **Email:** admin@tierragroove.com
- **Sitio web:** [https://tierragroove.com.mx/](https://tierragroove.com.mx/)

---

**Desarrollado con ❤️ para Tierra Groove Festival**

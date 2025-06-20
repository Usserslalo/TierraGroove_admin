# 🚀 Guía de Instalación - Tierra Groove Admin

Esta guía te ayudará a configurar el panel de administración de Tierra Groove Festival paso a paso.

## 📋 Prerrequisitos

Antes de comenzar, asegúrate de tener instalado:

- **PHP 8.2+** con las siguientes extensiones:
  - BCMath PHP Extension
  - Ctype PHP Extension
  - cURL PHP Extension
  - DOM PHP Extension
  - Fileinfo PHP Extension
  - JSON PHP Extension
  - Mbstring PHP Extension
  - OpenSSL PHP Extension
  - PCRE PHP Extension
  - PDO PHP Extension
  - Tokenizer PHP Extension
  - XML PHP Extension

- **Composer** (gestor de dependencias de PHP)
- **Node.js** y **NPM** (para compilar assets)
- **Base de datos** (MySQL, PostgreSQL o SQLite)

## 🛠️ Instalación Paso a Paso

### 1. Clonar el Proyecto

```bash
git clone [URL_DEL_REPOSITORIO]
cd TierraGroove_admin
```

### 2. Instalar Dependencias de PHP

```bash
composer install
```

### 3. Configurar Variables de Entorno

```bash
cp .env.example .env
```

Edita el archivo `.env` con tu configuración:

```env
APP_NAME="Tierra Groove Admin"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tierragroove_admin
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

### 4. Generar Clave de Aplicación

```bash
php artisan key:generate
```

### 5. Configurar Base de Datos

Crea una base de datos llamada `tierragroove_admin` en tu servidor MySQL.

### 6. Ejecutar Migraciones

```bash
php artisan migrate
```

### 7. Ejecutar Seeders (Datos de Ejemplo)

```bash
php artisan db:seed
```

### 8. Configurar Almacenamiento

```bash
php artisan storage:link
```

### 9. Instalar Dependencias de Node.js

```bash
npm install
```

### 10. Compilar Assets (Opcional)

```bash
npm run build
```

### 11. Crear Usuario Administrador

```bash
php artisan tinker
```

En el tinker, ejecuta:

```php
use App\Models\User;
User::create([
    'name' => 'Administrador',
    'email' => 'admin@tierragroove.com',
    'password' => bcrypt('tu_password_seguro')
]);
```

### 12. Iniciar el Servidor

```bash
php artisan serve
```

## 🌐 Acceso al Panel

El panel de administración estará disponible en:
- **URL:** http://localhost:8000/admin
- **Email:** admin@tierragroove.com
- **Password:** tu_password_seguro

## 📊 Datos de Ejemplo Incluidos

El seeder incluye:

### Festival
- **Tierra Groove Festival 2025**
- Fechas: 15-17 de Junio, 2025
- Ubicación: Grutas de Tolantongo, Hidalgo

### Artistas
- DJ Groove Master (México)
- Electro Vibes (España)
- Bass Nation (Estados Unidos)

### Escenarios
- Main Stage (2000 personas)
- Underground Stage (800 personas)
- Chill Zone (500 personas)

### Tipos de Boletos
- Pase General ($1,500 MXN)
- VIP Experience ($3,500 MXN)
- Pase de 1 Día ($800 MXN)

## 🔧 Comandos Útiles

### Desarrollo
```bash
# Iniciar servidor de desarrollo
php artisan serve

# Compilar assets en modo desarrollo
npm run dev

# Ver logs en tiempo real
php artisan pail
```

### Base de Datos
```bash
# Ejecutar migraciones
php artisan migrate

# Revertir última migración
php artisan migrate:rollback

# Ejecutar seeders
php artisan db:seed

# Resetear base de datos
php artisan migrate:fresh --seed
```

### Mantenimiento
```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Optimizar para producción
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🚨 Solución de Problemas

### Error: "Class 'App\Models\Festival' not found"
```bash
composer dump-autoload
```

### Error: "No application encryption key has been specified"
```bash
php artisan key:generate
```

### Error: "SQLSTATE[HY000] [1045] Access denied"
Verifica las credenciales de la base de datos en el archivo `.env`

### Error: "The stream or file could not be opened"
```bash
php artisan storage:link
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

### Error: "Permission denied" en Windows
Ejecuta PowerShell como administrador y ejecuta:
```powershell
Set-ExecutionPolicy RemoteSigned
```

## 📁 Estructura de Directorios Importantes

```
TierraGroove_admin/
├── app/
│   ├── Http/Controllers/Admin/     # Controladores del panel
│   └── Models/                     # Modelos de datos
├── database/
│   ├── migrations/                 # Estructura de BD
│   └── seeders/                    # Datos de ejemplo
├── resources/
│   └── views/admin/                # Vistas del panel
├── storage/
│   └── app/public/                 # Archivos subidos
└── public/
    └── storage -> ../storage/app/public  # Enlace simbólico
```

## 🔒 Configuración de Seguridad

### Para Producción
1. Cambiar `APP_ENV=production`
2. Cambiar `APP_DEBUG=false`
3. Configurar HTTPS
4. Usar contraseñas seguras
5. Configurar firewall

### Variables de Entorno de Producción
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tu-dominio.com
DB_HOST=tu-servidor-db
DB_PASSWORD=password_muy_seguro
```

## 📞 Soporte

Si encuentras problemas durante la instalación:

1. Verifica que todos los prerrequisitos estén instalados
2. Revisa los logs en `storage/logs/laravel.log`
3. Consulta la documentación de Laravel
4. Contacta al equipo de desarrollo

---

**¡Listo! Tu panel de administración de Tierra Groove Festival está configurado y listo para usar.** 
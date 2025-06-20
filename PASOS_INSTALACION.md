# 🚀 Pasos de Instalación Manual - Tierra Groove Admin

## ⚠️ Problema Resuelto
Ya hemos creado las vistas de autenticación que faltaban. Ahora puedes seguir estos pasos para completar la instalación.

## 📋 Pasos a Seguir

### 1. Configurar Base de Datos
Asegúrate de que tu archivo `.env` tenga la configuración correcta de la base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tierragroove_admin
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

### 2. Ejecutar Comandos en Orden

Abre una terminal en la carpeta del proyecto y ejecuta estos comandos uno por uno:

```bash
# 1. Instalar dependencias de PHP
composer install

# 2. Generar clave de aplicación
php artisan key:generate

# 3. Ejecutar migraciones (crear tablas)
php artisan migrate

# 4. Ejecutar seeders (datos de ejemplo)
php artisan db:seed

# 5. Crear enlace de storage
php artisan storage:link

# 6. Instalar dependencias de Node.js
npm install

# 7. Compilar assets
npm run build
```

### 3. Crear Usuario Administrador

Ejecuta este comando para crear un usuario administrador:

```bash
php artisan tinker
```

En el tinker, ejecuta:

```php
use App\Models\User;
User::create([
    'name' => 'Administrador',
    'email' => 'admin@tierragroove.com',
    'password' => bcrypt('password')
]);
```

### 4. Iniciar el Servidor

```bash
php artisan serve
```

## 🌐 Acceso al Sistema

- **URL del sitio:** http://localhost:8000
- **URL del panel admin:** http://localhost:8000/admin
- **Login:** http://localhost:8000/login
- **Registro:** http://localhost:8000/register

### Credenciales de Acceso
- **Email:** admin@tierragroove.com
- **Password:** password

## 🔧 Scripts Automatizados (Opcional)

Si prefieres usar scripts automatizados:

1. **Para instalación completa:** Ejecuta `install.bat`
2. **Para crear usuario admin:** Ejecuta `create-admin.bat`

## 🚨 Solución de Problemas

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "No application encryption key"
```bash
php artisan key:generate
```

### Error: "Database connection failed"
- Verifica las credenciales en `.env`
- Asegúrate de que la base de datos existe
- Verifica que el servidor MySQL esté corriendo

### Error: "Permission denied" en Windows
Ejecuta PowerShell como administrador:
```powershell
Set-ExecutionPolicy RemoteSigned
```

## 📊 Datos Incluidos

El seeder incluye automáticamente:

- **Festival:** Tierra Groove Festival 2025
- **Artistas:** 3 artistas de ejemplo
- **Escenarios:** 3 escenarios del festival
- **Boletos:** 3 tipos de boletos
- **Galería:** 2 imágenes de ejemplo

## ✅ Verificación

Para verificar que todo funciona:

1. Ve a http://localhost:8000/login
2. Inicia sesión con las credenciales
3. Deberías ver el dashboard del panel de administración
4. Navega a "Festivales" para ver los datos de ejemplo

---

**¡Listo! Tu panel de administración de Tierra Groove Festival está funcionando.** 
@echo off
echo ========================================
echo Instalacion de Tierra Groove Admin
echo ========================================
echo.

echo 1. Instalando dependencias de PHP...
composer install

echo.
echo 2. Generando clave de aplicacion...
php artisan key:generate

echo.
echo 3. Ejecutando migraciones...
php artisan migrate

echo.
echo 4. Ejecutando seeders...
php artisan db:seed

echo.
echo 5. Creando enlace de storage...
php artisan storage:link

echo.
echo 6. Instalando dependencias de Node.js...
npm install

echo.
echo 7. Compilando assets...
npm run build

echo.
echo ========================================
echo Instalacion completada!
echo ========================================
echo.
echo Para iniciar el servidor ejecuta:
echo php artisan serve
echo.
echo El panel estara disponible en:
echo http://localhost:8000/admin
echo.
echo Credenciales por defecto:
echo Email: admin@tierragroove.com
echo Password: password
echo.
pause 
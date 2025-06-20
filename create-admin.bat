@echo off
echo ========================================
echo Creando Usuario Administrador
echo ========================================
echo.

echo Ejecutando comando para crear usuario...
php artisan tinker --execute="use App\Models\User; User::create(['name' => 'Administrador', 'email' => 'admin@tierragroove.com', 'password' => bcrypt('password')]); echo 'Usuario creado exitosamente';"

echo.
echo ========================================
echo Usuario creado!
echo ========================================
echo.
echo Credenciales:
echo Email: admin@tierragroove.com
echo Password: password
echo.
pause 
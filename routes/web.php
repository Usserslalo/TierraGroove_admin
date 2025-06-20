<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FestivalController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\NavigationController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\AuthController;

// Ruta principal del sitio público
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rutas del panel de administración
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Gestión de Festivales
    Route::resource('festivals', FestivalController::class);
    
    // Gestión de Galería
    Route::resource('gallery', GalleryController::class);
    Route::post('gallery/reorder', [GalleryController::class, 'reorder'])->name('gallery.reorder');
    
    // Gestión de Navegación
    Route::resource('navigation', NavigationController::class);
    Route::post('navigation/reorder', [NavigationController::class, 'reorder'])->name('navigation.reorder');
    Route::patch('navigation/{navigationItem}/toggle', [NavigationController::class, 'toggleStatus'])->name('navigation.toggle');
    
    // Gestión de Redes Sociales
    Route::resource('social-links', SocialLinkController::class);
    Route::post('social-links/reorder', [SocialLinkController::class, 'reorder'])->name('social-links.reorder');
    Route::patch('social-links/{socialLink}/toggle', [SocialLinkController::class, 'toggleStatus'])->name('social-links.toggle');
    
    // Configuraciones del Sitio
    Route::get('site-settings', [SiteSettingsController::class, 'index'])->name('site-settings.index');
    Route::put('site-settings', [SiteSettingsController::class, 'update'])->name('site-settings.update');
    Route::post('site-settings/initialize', [SiteSettingsController::class, 'initializeSettings'])->name('site-settings.initialize');
    
    // Aquí agregaremos más rutas para artistas, escenarios, boletos, etc.
});

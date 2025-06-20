<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Tierra Groove Admin')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="bg-gray-800 text-white w-64 py-6 flex flex-col">
            <div class="px-6 mb-8">
                <h1 class="text-2xl font-bold">Tierra Groove</h1>
                <p class="text-gray-400 text-sm">Panel de Administración</p>
            </div>
            
            <nav class="flex-1">
                <ul class="space-y-2 px-6">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                    </li>
                    
                    <!-- Gestión de Contenido -->
                    <li class="mt-6">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 mb-2">Contenido</p>
                    </li>
                    <li>
                        <a href="{{ route('admin.festivals.index') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-calendar-alt mr-3"></i>
                            Festivales
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-music mr-3"></i>
                            Artistas
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-theater-masks mr-3"></i>
                            Escenarios
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-ticket-alt mr-3"></i>
                            Boletos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.gallery.index') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-images mr-3"></i>
                            Galería
                        </a>
                    </li>
                    
                    <!-- Configuración del Sitio -->
                    <li class="mt-6">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 mb-2">Configuración</p>
                    </li>
                    <li>
                        <a href="{{ route('admin.navigation.index') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-bars mr-3"></i>
                            Navegación
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.social-links.index') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-share-alt mr-3"></i>
                            Redes Sociales
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.site-settings.index') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-cog mr-3"></i>
                            Configuraciones
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="px-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg w-full">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-800">@yield('header', 'Dashboard')</h2>
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-600">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html> 
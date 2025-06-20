@extends('admin.layouts.app')

@section('title', 'Dashboard - Tierra Groove Admin')
@section('header', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-music text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Artistas</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['artists'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-theater-masks text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Escenarios</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['stages'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-ticket-alt text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Tipos de Boletos</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['tickets'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-images text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Imágenes</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['gallery_items'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Festival Info -->
    @if($activeFestival)
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Festival Activo</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">{{ $activeFestival->name }}</h4>
                    <p class="text-gray-600 mb-4">{{ $activeFestival->description }}</p>
                    <div class="space-y-2">
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-calendar mr-2"></i>
                            {{ $activeFestival->start_date->format('d/m/Y') }} - {{ $activeFestival->end_date->format('d/m/Y') }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            {{ $activeFestival->location }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-clock mr-2"></i>
                            {{ $activeFestival->getDaysUntilEvent() }} días restantes
                        </p>
                    </div>
                </div>
                @if($activeFestival->featured_image)
                <div class="flex justify-center">
                    <img src="{{ Storage::url($activeFestival->featured_image) }}" 
                         alt="{{ $activeFestival->name }}" 
                         class="w-64 h-48 object-cover rounded-lg">
                </div>
                @endif
            </div>
        </div>
    </div>
    @else
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle text-yellow-600 mr-3"></i>
            <div>
                <h3 class="text-lg font-medium text-yellow-800">No hay festival activo</h3>
                <p class="text-yellow-700">Crea un nuevo festival para comenzar.</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Featured Artists -->
    @if($featuredArtists->count() > 0)
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Artistas Destacados</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($featuredArtists as $artist)
                <div class="border rounded-lg p-4">
                    @if($artist->image)
                    <img src="{{ Storage::url($artist->image) }}" 
                         alt="{{ $artist->name }}" 
                         class="w-full h-32 object-cover rounded-lg mb-3">
                    @endif
                    <h4 class="font-semibold text-gray-900">{{ $artist->name }}</h4>
                    <p class="text-sm text-gray-600">{{ $artist->genre }} • {{ $artist->country }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Recent Gallery -->
    @if($recentGallery->count() > 0)
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Galería Reciente</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach($recentGallery as $image)
                <div class="aspect-square">
                    <img src="{{ Storage::url($image->image) }}" 
                         alt="{{ $image->title }}" 
                         class="w-full h-full object-cover rounded-lg">
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection 
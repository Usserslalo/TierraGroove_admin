@extends('admin.layouts.app')

@section('title', 'Editar Red Social')

@section('header', 'Editar Red Social')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900">Editar: {{ $socialLink->name }}</h3>
            <a href="{{ route('admin.social-links.index') }}" class="text-blue-600 hover:text-blue-900">
                <i class="fas fa-arrow-left mr-2"></i>Volver
            </a>
        </div>
    </div>

    <form action="{{ route('admin.social-links.update', $socialLink) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="platform" class="block text-sm font-medium text-gray-700 mb-2">Plataforma</label>
                <select name="platform" id="platform" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Seleccionar plataforma</option>
                    @foreach($platforms as $key => $name)
                        <option value="{{ $key }}" {{ old('platform', $socialLink->platform) == $key ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
                @error('platform')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                <input type="text" name="name" id="name" value="{{ old('name', $socialLink->name) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="url" class="block text-sm font-medium text-gray-700 mb-2">URL del Perfil</label>
                <input type="url" name="url" id="url" value="{{ old('url', $socialLink->url) }}" required placeholder="https://facebook.com/tierragroove"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('url')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">Clase del Icono</label>
                <input type="text" name="icon" id="icon" value="{{ old('icon', $socialLink->icon) }}" required placeholder="fab fa-facebook"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="mt-1 text-xs text-gray-500">Ejemplo: fab fa-facebook, fab fa-instagram, etc.</p>
                @error('icon')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Color Personalizado (opcional)</label>
                <input type="color" name="color" id="color" value="{{ old('color', $socialLink->color) }}"
                    class="w-full h-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="mt-1 text-xs text-gray-500">Deja vacío para usar el color por defecto de la plataforma</p>
                @error('color')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Orden</label>
                <input type="number" name="order" id="order" value="{{ old('order', $socialLink->order) }}" min="0"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" 
                        {{ old('is_active', $socialLink->is_active) ? 'checked' : '' }}
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        Red social activa (visible en el footer)
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.social-links.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Cancelar
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                <i class="fas fa-save mr-2"></i>Actualizar Red Social
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const platformSelect = document.getElementById('platform');
    const iconInput = document.getElementById('icon');
    const colorInput = document.getElementById('color');
    
    const platformDefaults = {
        'facebook': { icon: 'fab fa-facebook', color: '#1877f2' },
        'instagram': { icon: 'fab fa-instagram', color: '#e4405f' },
        'twitter': { icon: 'fab fa-twitter', color: '#1da1f2' },
        'youtube': { icon: 'fab fa-youtube', color: '#ff0000' },
        'tiktok': { icon: 'fab fa-tiktok', color: '#000000' },
        'spotify': { icon: 'fab fa-spotify', color: '#1db954' },
        'linkedin': { icon: 'fab fa-linkedin', color: '#0077b5' },
        'whatsapp': { icon: 'fab fa-whatsapp', color: '#25d366' },
        'telegram': { icon: 'fab fa-telegram', color: '#0088cc' },
        'discord': { icon: 'fab fa-discord', color: '#5865f2' },
    };
    
    platformSelect.addEventListener('change', function() {
        const selectedPlatform = this.value;
        if (platformDefaults[selectedPlatform]) {
            iconInput.value = platformDefaults[selectedPlatform].icon;
            colorInput.value = platformDefaults[selectedPlatform].color;
        }
    });
});
</script>
@endsection 
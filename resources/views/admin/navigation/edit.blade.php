@extends('admin.layouts.app')

@section('title', 'Editar Elemento de Navegación')

@section('header', 'Editar Elemento de Navegación')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900">Editar: {{ $navigationItem->name }}</h3>
            <a href="{{ route('admin.navigation.index') }}" class="text-blue-600 hover:text-blue-900">
                <i class="fas fa-arrow-left mr-2"></i>Volver
            </a>
        </div>
    </div>

    <form action="{{ route('admin.navigation.update', $navigationItem) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                <input type="text" name="name" id="name" value="{{ old('name', $navigationItem->name) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $navigationItem->slug) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">Icono (opcional)</label>
                <input type="text" name="icon" id="icon" value="{{ old('icon', $navigationItem->icon) }}" placeholder="fas fa-home"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="mt-1 text-xs text-gray-500">Ejemplo: fas fa-home, fas fa-music, etc.</p>
                @error('icon')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Orden</label>
                <input type="number" name="order" id="order" value="{{ old('order', $navigationItem->order) }}" min="0"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <div class="flex items-center mb-4">
                    <input type="checkbox" name="is_external" id="is_external" value="1" 
                        {{ old('is_external', $navigationItem->is_external) ? 'checked' : '' }}
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_external" class="ml-2 block text-sm text-gray-900">
                        Es un enlace externo
                    </label>
                </div>
            </div>

            <div id="route-field">
                <label for="route" class="block text-sm font-medium text-gray-700 mb-2">Ruta Laravel</label>
                <input type="text" name="route" id="route" value="{{ old('route', $navigationItem->route) }}" placeholder="home, about, contact"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('route')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div id="url-field" style="display: none;">
                <label for="url" class="block text-sm font-medium text-gray-700 mb-2">URL Externa</label>
                <input type="url" name="url" id="url" value="{{ old('url', $navigationItem->url) }}" placeholder="https://ejemplo.com"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('url')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" 
                        {{ old('is_active', $navigationItem->is_active) ? 'checked' : '' }}
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        Elemento activo (visible en el menú)
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.navigation.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Cancelar
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                <i class="fas fa-save mr-2"></i>Actualizar Elemento
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const externalCheckbox = document.getElementById('is_external');
    const routeField = document.getElementById('route-field');
    const urlField = document.getElementById('url-field');

    function toggleFields() {
        if (externalCheckbox.checked) {
            routeField.style.display = 'none';
            urlField.style.display = 'block';
        } else {
            routeField.style.display = 'block';
            urlField.style.display = 'none';
        }
    }

    externalCheckbox.addEventListener('change', toggleFields);
    toggleFields(); // Ejecutar al cargar la página
});
</script>
@endsection 
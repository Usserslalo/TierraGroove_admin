@extends('admin.layouts.app')

@section('title', 'Crear Festival - Tierra Groove Admin')
@section('header', 'Crear Nuevo Festival')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Información del Festival</h3>
        </div>
        
        <form action="{{ route('admin.festivals.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nombre del Festival -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Festival</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Estado -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Estado</label>
                    <select name="status" id="status" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Borrador</option>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Activo</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Descripción -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="description" id="description" rows="4" 
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Fecha de Inicio -->
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('start_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fecha de Fin -->
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Fecha de Fin</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('end_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Ubicación -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Ubicación</label>
                    <input type="text" name="location" id="location" value="{{ old('location') }}" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Coordenadas -->
                <div>
                    <label for="location_coordinates" class="block text-sm font-medium text-gray-700">Coordenadas (opcional)</label>
                    <input type="text" name="location_coordinates" id="location_coordinates" value="{{ old('location_coordinates') }}" 
                           placeholder="20.5937, -103.7242" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('location_coordinates')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Imagen Destacada -->
            <div>
                <label for="featured_image" class="block text-sm font-medium text-gray-700">Imagen Destacada</label>
                <input type="file" name="featured_image" id="featured_image" accept="image/*" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <p class="mt-1 text-sm text-gray-500">Formatos: JPEG, PNG, JPG, GIF. Máximo 2MB.</p>
                @error('featured_image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Enlaces Sociales -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Enlaces Sociales</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="social_links[facebook]" class="block text-sm text-gray-600">Facebook</label>
                        <input type="url" name="social_links[facebook]" id="social_links[facebook]" 
                               value="{{ old('social_links.facebook') }}" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="social_links[instagram]" class="block text-sm text-gray-600">Instagram</label>
                        <input type="url" name="social_links[instagram]" id="social_links[instagram]" 
                               value="{{ old('social_links.instagram') }}" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.festivals.index') }}" 
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                    Cancelar
                </a>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    Crear Festival
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 
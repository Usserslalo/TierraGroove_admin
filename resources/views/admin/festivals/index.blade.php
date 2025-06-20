@extends('admin.layouts.app')

@section('title', 'Festivales - Tierra Groove Admin')
@section('header', 'Gestión de Festivales')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <h3 class="text-lg font-medium text-gray-900">Lista de Festivales</h3>
        <a href="{{ route('admin.festivals.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Nuevo Festival
        </a>
    </div>

    <!-- Festivals Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Festival
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Fechas
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Ubicación
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Estado
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($festivals as $festival)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($festival->featured_image)
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-lg object-cover" 
                                     src="{{ Storage::url($festival->featured_image) }}" 
                                     alt="{{ $festival->name }}">
                            </div>
                            @endif
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $festival->name }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($festival->description, 50) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $festival->start_date->format('d/m/Y') }} - {{ $festival->end_date->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $festival->location }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($festival->status === 'active')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Activo
                            </span>
                        @elseif($festival->status === 'inactive')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Inactivo
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Borrador
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.festivals.edit', $festival) }}" 
                               class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.festivals.destroy', $festival) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('¿Estás seguro de que quieres eliminar este festival?')"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        No hay festivales registrados
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection 
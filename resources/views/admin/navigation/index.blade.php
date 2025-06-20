@extends('admin.layouts.app')

@section('title', 'Gestión de Navegación')

@section('header', 'Gestión de Navegación')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900">Elementos de Navegación</h3>
            <a href="{{ route('admin.navigation.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-plus mr-2"></i>Nuevo Elemento
            </a>
        </div>
    </div>

    <div class="p-6">
        @if($navigationItems->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orden</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="sortable-navigation">
                        @foreach($navigationItems as $item)
                            <tr data-id="{{ $item->id }}" class="hover:bg-gray-50 cursor-move">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <i class="fas fa-grip-vertical text-gray-400 mr-2"></i>{{ $item->order }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($item->icon)
                                            <i class="{{ $item->icon }} mr-3 text-gray-400"></i>
                                        @endif
                                        <span class="text-sm font-medium text-gray-900">{{ $item->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->slug }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($item->is_external)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Externo
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Interno
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($item->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Activo
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Inactivo
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.navigation.edit', $item) }}" class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.navigation.toggle', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-yellow-600 hover:text-yellow-900">
                                                @if($item->is_active)
                                                    <i class="fas fa-eye-slash"></i>
                                                @else
                                                    <i class="fas fa-eye"></i>
                                                @endif
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.navigation.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este elemento?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-bars text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No hay elementos de navegación</h3>
                <p class="text-gray-500 mb-6">Comienza creando el primer elemento de navegación.</p>
                <a href="{{ route('admin.navigation.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    <i class="fas fa-plus mr-2"></i>Crear Elemento
                </a>
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortableList = document.getElementById('sortable-navigation');
    if (sortableList) {
        new Sortable(sortableList, {
            animation: 150,
            onEnd: function(evt) {
                const items = Array.from(sortableList.children).map((row, index) => ({
                    id: row.dataset.id,
                    order: index
                }));
                
                fetch('{{ route("admin.navigation.reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ items: items.map(item => item.id) })
                });
            }
        });
    }
});
</script>
@endsection 
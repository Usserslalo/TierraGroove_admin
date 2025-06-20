@extends('admin.layouts.app')

@section('title', 'Gestión de Redes Sociales')

@section('header', 'Gestión de Redes Sociales')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900">Redes Sociales</h3>
            <a href="{{ route('admin.social-links.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-plus mr-2"></i>Nueva Red Social
            </a>
        </div>
    </div>

    <div class="p-6">
        @if($socialLinks->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orden</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plataforma</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Color</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="sortable-social">
                        @foreach($socialLinks as $link)
                            <tr data-id="{{ $link->id }}" class="hover:bg-gray-50 cursor-move">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <i class="fas fa-grip-vertical text-gray-400 mr-2"></i>{{ $link->order }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="{{ $link->icon }} mr-3" style="color: {{ $link->display_color }}"></i>
                                        <span class="text-sm font-medium text-gray-900">{{ $link->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <a href="{{ $link->url }}" target="_blank" class="text-blue-600 hover:text-blue-900 truncate block max-w-xs">
                                        {{ $link->url }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 rounded-full mr-2" style="background-color: {{ $link->display_color }}"></div>
                                        <span class="text-sm text-gray-500">{{ $link->display_color }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($link->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Activa
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Inactiva
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.social-links.edit', $link) }}" class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.social-links.toggle', $link) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-yellow-600 hover:text-yellow-900">
                                                @if($link->is_active)
                                                    <i class="fas fa-eye-slash"></i>
                                                @else
                                                    <i class="fas fa-eye"></i>
                                                @endif
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.social-links.destroy', $link) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta red social?')">
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
                <i class="fas fa-share-alt text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No hay redes sociales configuradas</h3>
                <p class="text-gray-500 mb-6">Comienza agregando las redes sociales del festival.</p>
                <a href="{{ route('admin.social-links.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    <i class="fas fa-plus mr-2"></i>Agregar Red Social
                </a>
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortableList = document.getElementById('sortable-social');
    if (sortableList) {
        new Sortable(sortableList, {
            animation: 150,
            onEnd: function(evt) {
                const items = Array.from(sortableList.children).map((row, index) => ({
                    id: row.dataset.id,
                    order: index
                }));
                
                fetch('{{ route("admin.social-links.reorder") }}', {
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
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavigationItem;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function index()
    {
        $navigationItems = NavigationItem::ordered()->get();
        return view('admin.navigation.index', compact('navigationItems'));
    }

    public function create()
    {
        return view('admin.navigation.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:navigation_items',
            'route' => 'nullable|string|max:255',
            'url' => 'nullable|url|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'is_external' => 'boolean',
            'icon' => 'nullable|string|max:255',
        ]);

        NavigationItem::create($validated);

        return redirect()->route('admin.navigation.index')
            ->with('success', 'Elemento de navegación creado exitosamente.');
    }

    public function edit(NavigationItem $navigationItem)
    {
        return view('admin.navigation.edit', compact('navigationItem'));
    }

    public function update(Request $request, NavigationItem $navigationItem)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:navigation_items,slug,' . $navigationItem->id,
            'route' => 'nullable|string|max:255',
            'url' => 'nullable|url|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'is_external' => 'boolean',
            'icon' => 'nullable|string|max:255',
        ]);

        $navigationItem->update($validated);

        return redirect()->route('admin.navigation.index')
            ->with('success', 'Elemento de navegación actualizado exitosamente.');
    }

    public function destroy(NavigationItem $navigationItem)
    {
        $navigationItem->delete();

        return redirect()->route('admin.navigation.index')
            ->with('success', 'Elemento de navegación eliminado exitosamente.');
    }

    public function reorder(Request $request)
    {
        $items = $request->input('items', []);
        
        foreach ($items as $index => $id) {
            NavigationItem::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    public function toggleStatus(NavigationItem $navigationItem)
    {
        $navigationItem->update(['is_active' => !$navigationItem->is_active]);

        return redirect()->route('admin.navigation.index')
            ->with('success', 'Estado del elemento actualizado exitosamente.');
    }
} 
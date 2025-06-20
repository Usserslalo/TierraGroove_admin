<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $images = Gallery::orderBy('order', 'asc')->get();
        return view('admin.gallery.index', compact('images'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alt_text' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gallery', 'public');
            $validated['image'] = $path;
        }

        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Imagen agregada exitosamente.');
    }

    public function edit(Gallery $image)
    {
        return view('admin.gallery.edit', compact('image'));
    }

    public function update(Request $request, Gallery $image)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alt_text' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($image->image) {
                Storage::disk('public')->delete($image->image);
            }
            $path = $request->file('image')->store('gallery', 'public');
            $validated['image'] = $path;
        }

        $image->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Imagen actualizada exitosamente.');
    }

    public function destroy(Gallery $image)
    {
        if ($image->image) {
            Storage::disk('public')->delete($image->image);
        }
        
        $image->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Imagen eliminada exitosamente.');
    }

    public function reorder(Request $request)
    {
        $items = $request->input('items', []);
        
        foreach ($items as $index => $id) {
            Gallery::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }
} 
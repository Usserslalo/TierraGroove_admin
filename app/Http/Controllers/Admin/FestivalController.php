<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Festival;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FestivalController extends Controller
{
    public function index()
    {
        $festivals = Festival::orderBy('created_at', 'desc')->get();
        return view('admin.festivals.index', compact('festivals'));
    }

    public function create()
    {
        return view('admin.festivals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'location_coordinates' => 'nullable|string',
            'status' => 'required|in:active,inactive,draft',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'social_links' => 'nullable|array',
        ]);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('festivals', 'public');
            $validated['featured_image'] = $path;
        }

        Festival::create($validated);

        return redirect()->route('admin.festivals.index')
            ->with('success', 'Festival creado exitosamente.');
    }

    public function edit(Festival $festival)
    {
        return view('admin.festivals.edit', compact('festival'));
    }

    public function update(Request $request, Festival $festival)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'location_coordinates' => 'nullable|string',
            'status' => 'required|in:active,inactive,draft',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'social_links' => 'nullable|array',
        ]);

        if ($request->hasFile('featured_image')) {
            // Eliminar imagen anterior si existe
            if ($festival->featured_image) {
                Storage::disk('public')->delete($festival->featured_image);
            }
            $path = $request->file('featured_image')->store('festivals', 'public');
            $validated['featured_image'] = $path;
        }

        $festival->update($validated);

        return redirect()->route('admin.festivals.index')
            ->with('success', 'Festival actualizado exitosamente.');
    }

    public function destroy(Festival $festival)
    {
        if ($festival->featured_image) {
            Storage::disk('public')->delete($festival->featured_image);
        }
        
        $festival->delete();

        return redirect()->route('admin.festivals.index')
            ->with('success', 'Festival eliminado exitosamente.');
    }
} 
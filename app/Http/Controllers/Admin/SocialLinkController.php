<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLinks = SocialLink::ordered()->get();
        return view('admin.social-links.index', compact('socialLinks'));
    }

    public function create()
    {
        $platforms = $this->getAvailablePlatforms();
        return view('admin.social-links.create', compact('platforms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon' => 'required|string|max:255',
            'color' => 'nullable|string|max:7',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        SocialLink::create($validated);

        return redirect()->route('admin.social-links.index')
            ->with('success', 'Red social creada exitosamente.');
    }

    public function edit(SocialLink $socialLink)
    {
        $platforms = $this->getAvailablePlatforms();
        return view('admin.social-links.edit', compact('socialLink', 'platforms'));
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon' => 'required|string|max:255',
            'color' => 'nullable|string|max:7',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $socialLink->update($validated);

        return redirect()->route('admin.social-links.index')
            ->with('success', 'Red social actualizada exitosamente.');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();

        return redirect()->route('admin.social-links.index')
            ->with('success', 'Red social eliminada exitosamente.');
    }

    public function reorder(Request $request)
    {
        $items = $request->input('items', []);
        
        foreach ($items as $index => $id) {
            SocialLink::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    public function toggleStatus(SocialLink $socialLink)
    {
        $socialLink->update(['is_active' => !$socialLink->is_active]);

        return redirect()->route('admin.social-links.index')
            ->with('success', 'Estado de la red social actualizado exitosamente.');
    }

    private function getAvailablePlatforms()
    {
        return [
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'twitter' => 'Twitter/X',
            'youtube' => 'YouTube',
            'tiktok' => 'TikTok',
            'spotify' => 'Spotify',
            'linkedin' => 'LinkedIn',
            'whatsapp' => 'WhatsApp',
            'telegram' => 'Telegram',
            'discord' => 'Discord',
        ];
    }
} 
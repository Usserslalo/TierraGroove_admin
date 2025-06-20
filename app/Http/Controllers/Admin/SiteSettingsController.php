<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->groupBy('group');
        return view('admin.site-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = $request->except('_token', '_method');
        
        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }

        // Manejo de subida de imágenes
        $image_fields = ['site_logo', 'nav_background_image', 'footer_background_image'];
        foreach ($image_fields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                
                // Borrar imagen anterior si existe
                $old_path = SiteSetting::get($field);
                if ($old_path) {
                    Storage::disk('public')->delete($old_path);
                }

                // Guardar nueva imagen
                $path = $file->store('settings', 'public');
                SiteSetting::set($field, $path);
            }
        }

        return redirect()->route('admin.site-settings.index')
            ->with('success', 'Configuraciones actualizadas exitosamente.');
    }

    public function initializeSettings()
    {
        $defaultSettings = [
            // General settings
            'site_title' => ['value' => 'Tierra Groove Festival', 'type' => 'text', 'group' => 'general', 'description' => 'Título principal del sitio'],
            'site_logo' => ['value' => null, 'type' => 'image', 'group' => 'general', 'description' => 'Logo del sitio (para el Nav)'],
            'site_description' => ['value' => 'Festival de música electrónica en las Grutas de Tolantongo, Hidalgo', 'type' => 'textarea', 'group' => 'general', 'description' => 'Descripción del sitio para SEO'],
            'nav_background_image' => ['value' => null, 'type' => 'image', 'group' => 'general', 'description' => 'Imagen de fondo para el Nav'],

            // Footer settings
            'copyright_text' => ['value' => '© 2025 Tierra Groove. Todos los derechos reservados.', 'type' => 'text', 'group' => 'footer', 'description' => 'Texto de derechos de autor en el footer'],
            'footer_description' => ['value' => 'Festival de música electrónica en las Grutas de Tolantongo', 'type' => 'textarea', 'group' => 'footer', 'description' => 'Descripción del festival en el footer'],
            'footer_background_image' => ['value' => null, 'type' => 'image', 'group' => 'footer', 'description' => 'Imagen de fondo para el Footer'],
            
            // Contact settings
            'contact_email' => ['value' => 'info@tierragroove.com.mx', 'type' => 'email', 'group' => 'contact', 'description' => 'Email de contacto principal'],
            'contact_phone' => ['value' => '+52 55 1234 5678', 'type' => 'text', 'group' => 'contact', 'description' => 'Teléfono de contacto'],
        ];

        foreach ($defaultSettings as $key => $setting) {
            SiteSetting::set($key, $setting['value'], $setting['type'], $setting['group'], $setting['description']);
        }

        return redirect()->route('admin.site-settings.index')
            ->with('success', 'Configuraciones inicializadas exitosamente.');
    }
} 
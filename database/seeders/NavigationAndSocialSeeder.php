<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NavigationItem;
use App\Models\SocialLink;
use App\Models\SiteSetting;

class NavigationAndSocialSeeder extends Seeder
{
    public function run(): void
    {
        // Crear elementos de navegación
        $navigationItems = [
            [
                'name' => 'Inicio',
                'slug' => 'inicio',
                'route' => 'home',
                'order' => 1,
                'is_active' => true,
                'is_external' => false,
                'icon' => 'fas fa-home'
            ],
            [
                'name' => 'Lineup',
                'slug' => 'lineup',
                'route' => 'lineup',
                'order' => 2,
                'is_active' => false, // Desactivado como solicitaste
                'is_external' => false,
                'icon' => 'fas fa-music'
            ],
            [
                'name' => 'Escenarios',
                'slug' => 'escenarios',
                'route' => 'stages',
                'order' => 3,
                'is_active' => true,
                'is_external' => false,
                'icon' => 'fas fa-theater-masks'
            ],
            [
                'name' => 'Boletos',
                'slug' => 'boletos',
                'route' => 'tickets',
                'order' => 4,
                'is_active' => false, // Desactivado como solicitaste
                'is_external' => false,
                'icon' => 'fas fa-ticket-alt'
            ],
            [
                'name' => 'Galería',
                'slug' => 'galeria',
                'route' => 'gallery',
                'order' => 5,
                'is_active' => true,
                'is_external' => false,
                'icon' => 'fas fa-images'
            ],
        ];

        foreach ($navigationItems as $item) {
            NavigationItem::create($item);
        }

        // Crear redes sociales
        $socialLinks = [
            [
                'platform' => 'facebook',
                'name' => 'Facebook',
                'url' => 'https://facebook.com/tierragroove',
                'icon' => 'fab fa-facebook',
                'color' => '#1877f2',
                'order' => 1,
                'is_active' => true
            ],
            [
                'platform' => 'instagram',
                'name' => 'Instagram',
                'url' => 'https://instagram.com/tierragroove',
                'icon' => 'fab fa-instagram',
                'color' => '#e4405f',
                'order' => 2,
                'is_active' => true
            ],
            [
                'platform' => 'twitter',
                'name' => 'Twitter/X',
                'url' => 'https://twitter.com/tierragroove',
                'icon' => 'fab fa-twitter',
                'color' => '#1da1f2',
                'order' => 3,
                'is_active' => false
            ],
            [
                'platform' => 'youtube',
                'name' => 'YouTube',
                'url' => 'https://youtube.com/@tierragroove',
                'icon' => 'fab fa-youtube',
                'color' => '#ff0000',
                'order' => 4,
                'is_active' => true
            ],
        ];

        foreach ($socialLinks as $link) {
            SocialLink::create($link);
        }

        // Crear configuraciones del sitio
        $siteSettings = [
            'copyright_text' => [
                'value' => '© 2025 Tierra Groove. Todos los derechos reservados.',
                'type' => 'text',
                'group' => 'footer',
                'description' => 'Texto de derechos de autor en el footer'
            ],
            'footer_description' => [
                'value' => 'Festival de música electrónica en las Grutas de Tolantongo, Hidalgo',
                'type' => 'textarea',
                'group' => 'footer',
                'description' => 'Descripción del festival en el footer'
            ],
            'site_title' => [
                'value' => 'Tierra Groove Festival',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Título principal del sitio'
            ],
            'site_description' => [
                'value' => 'Festival de música electrónica en las Grutas de Tolantongo, Hidalgo',
                'type' => 'textarea',
                'group' => 'general',
                'description' => 'Descripción del sitio para SEO'
            ],
            'contact_email' => [
                'value' => 'info@tierragroove.com.mx',
                'type' => 'email',
                'group' => 'contact',
                'description' => 'Email de contacto principal'
            ],
            'contact_phone' => [
                'value' => '+52 55 1234 5678',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Teléfono de contacto'
            ],
        ];

        foreach ($siteSettings as $key => $setting) {
            SiteSetting::set($key, $setting['value'], $setting['type'], $setting['group'], $setting['description']);
        }
    }
} 
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Festival;
use App\Models\Artist;
use App\Models\Stage;
use App\Models\Ticket;
use App\Models\Gallery;

class FestivalSeeder extends Seeder
{
    public function run(): void
    {
        // Crear festival principal
        $festival = Festival::create([
            'name' => 'Tierra Groove Festival',
            'description' => 'Sumérgete en una experiencia única donde la música electrónica se fusiona con la majestuosidad de la naturaleza. Tierra Groove es un festival que celebra la conexión entre el sonido, el arte y el entorno natural en las impresionantes Grutas de Tolantongo, Hidalgo.',
            'start_date' => '2025-06-15',
            'end_date' => '2025-06-17',
            'location' => 'Grutas de Tolantongo, Hidalgo',
            'location_coordinates' => '20.5937, -103.7242',
            'status' => 'active',
            'social_links' => [
                'facebook' => 'https://facebook.com/tierragroove',
                'instagram' => 'https://instagram.com/tierragroove'
            ]
        ]);

        // Crear artistas de ejemplo
        $artists = [
            [
                'name' => 'DJ Groove Master',
                'bio' => 'Productor y DJ mexicano especializado en house y techno',
                'genre' => 'House/Techno',
                'country' => 'México',
                'order' => 1,
                'is_featured' => true,
                'status' => 'active'
            ],
            [
                'name' => 'Electro Vibes',
                'bio' => 'Duo de música electrónica experimental',
                'genre' => 'Electronica',
                'country' => 'España',
                'order' => 2,
                'is_featured' => true,
                'status' => 'active'
            ],
            [
                'name' => 'Bass Nation',
                'bio' => 'Artista internacional de bass music',
                'genre' => 'Bass Music',
                'country' => 'Estados Unidos',
                'order' => 3,
                'is_featured' => false,
                'status' => 'active'
            ]
        ];

        foreach ($artists as $artistData) {
            Artist::create($artistData);
        }

        // Crear escenarios
        $stages = [
            [
                'name' => 'Main Stage',
                'description' => 'Escenario principal con vista a las grutas',
                'capacity' => 2000,
                'location_description' => 'Frente a las grutas principales',
                'order' => 1,
                'is_active' => true
            ],
            [
                'name' => 'Underground Stage',
                'description' => 'Escenario subterráneo con acústica única',
                'capacity' => 800,
                'location_description' => 'Dentro de las cuevas',
                'order' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Chill Zone',
                'description' => 'Área de descanso con música ambiental',
                'capacity' => 500,
                'location_description' => 'Cerca de las aguas termales',
                'order' => 3,
                'is_active' => true
            ]
        ];

        foreach ($stages as $stageData) {
            Stage::create($stageData);
        }

        // Crear tipos de boletos
        $tickets = [
            [
                'name' => 'Pase General',
                'description' => 'Acceso a todos los escenarios y actividades',
                'price' => 1500.00,
                'quantity_available' => 1000,
                'benefits' => ['Acceso a todos los escenarios', 'Camping incluido', 'Acceso a aguas termales'],
                'order' => 1,
                'status' => 'active'
            ],
            [
                'name' => 'VIP Experience',
                'description' => 'Experiencia premium con beneficios exclusivos',
                'price' => 3500.00,
                'quantity_available' => 200,
                'benefits' => ['Área VIP', 'Comida incluida', 'Meet & Greet con artistas', 'Merchandise exclusivo'],
                'order' => 2,
                'status' => 'active'
            ],
            [
                'name' => 'Pase de 1 Día',
                'description' => 'Acceso por un día específico',
                'price' => 800.00,
                'quantity_available' => 500,
                'benefits' => ['Acceso a todos los escenarios', 'Acceso a aguas termales'],
                'order' => 3,
                'status' => 'active'
            ]
        ];

        foreach ($tickets as $ticketData) {
            Ticket::create($ticketData);
        }

        // Crear imágenes de galería (sin archivos reales por ahora)
        $gallery = [
            [
                'title' => 'Vista de las Grutas',
                'description' => 'Impresionante vista de las grutas de Tolantongo',
                'image' => 'gallery/grutas-vista.jpg',
                'alt_text' => 'Vista panorámica de las grutas',
                'category' => 'festival',
                'order' => 1,
                'is_featured' => true,
                'is_active' => true
            ],
            [
                'title' => 'Aguas Termales',
                'description' => 'Relájate en las aguas termales naturales',
                'image' => 'gallery/aguas-termales.jpg',
                'alt_text' => 'Aguas termales de Tolantongo',
                'category' => 'festival',
                'order' => 2,
                'is_featured' => true,
                'is_active' => true
            ]
        ];

        foreach ($gallery as $imageData) {
            Gallery::create($imageData);
        }
    }
} 
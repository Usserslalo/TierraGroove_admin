<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            [
                'title' => 'Festival Tierra Groove 2024',
                'description' => 'Momentos increíbles del festival',
                'image_path' => 'gallery/festival-1.jpg',
                'order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'Escenario Principal',
                'description' => 'El escenario principal en su máximo esplendor',
                'image_path' => 'gallery/stage-1.jpg',
                'order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'Multitud Bailando',
                'description' => 'La energía de la multitud fue increíble',
                'image_path' => 'gallery/crowd-1.jpg',
                'order' => 3,
                'is_active' => true
            ],
        ];

        foreach ($images as $image) {
            Gallery::create($image);
        }
    }
} 
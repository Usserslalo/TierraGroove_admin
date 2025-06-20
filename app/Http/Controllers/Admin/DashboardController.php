<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Festival;
use App\Models\Gallery;
use App\Models\Stage;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'artists' => Artist::active()->count(),
            'stages' => Stage::active()->count(),
            'tickets' => Ticket::active()->count(),
            'gallery_items' => Gallery::active()->count(),
        ];

        $activeFestival = Festival::where('status', 'active')->first();
        $featuredArtists = Artist::featured()->active()->ordered()->take(5)->get();
        $recentGallery = Gallery::active()->ordered()->take(6)->get();

        return view('admin.dashboard', compact('stats', 'activeFestival', 'featuredArtists', 'recentGallery'));
    }
} 
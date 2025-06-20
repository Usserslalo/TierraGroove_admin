<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'location',
        'location_coordinates',
        'status',
        'featured_image',
        'social_links',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'social_links' => 'array',
    ];

    public function getActiveFestival()
    {
        return $this->where('status', 'active')->first();
    }

    public function getDaysUntilEvent()
    {
        return now()->diffInDays($this->start_date, false);
    }

    public function isUpcoming()
    {
        return $this->start_date->isFuture();
    }
} 
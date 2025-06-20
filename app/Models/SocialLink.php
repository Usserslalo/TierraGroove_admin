<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform',
        'name',
        'url',
        'icon',
        'color',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function getDisplayColorAttribute()
    {
        return $this->color ?: $this->getDefaultColor();
    }

    private function getDefaultColor()
    {
        $colors = [
            'facebook' => '#1877f2',
            'instagram' => '#e4405f',
            'twitter' => '#1da1f2',
            'youtube' => '#ff0000',
            'tiktok' => '#000000',
            'spotify' => '#1db954',
            'linkedin' => '#0077b5',
        ];

        return $colors[$this->platform] ?? '#666666';
    }
} 
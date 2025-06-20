<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavigationItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'route',
        'url',
        'order',
        'is_active',
        'is_external',
        'icon',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_external' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function getFullUrlAttribute()
    {
        if ($this->is_external) {
            return $this->url;
        }
        
        return $this->route ? route($this->route) : url($this->slug);
    }
} 
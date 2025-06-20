<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity_available',
        'quantity_sold',
        'sale_start_date',
        'sale_end_date',
        'benefits',
        'status',
        'order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'benefits' => 'array',
        'sale_start_date' => 'date',
        'sale_end_date' => 'date',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeAvailable($query)
    {
        return $query->where('quantity_available', '>', 0);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function getRemainingQuantityAttribute()
    {
        return $this->quantity_available - $this->quantity_sold;
    }

    public function isSoldOut()
    {
        return $this->remaining_quantity <= 0;
    }

    public function isOnSale()
    {
        $now = now();
        return $this->sale_start_date <= $now && 
               ($this->sale_end_date === null || $this->sale_end_date >= $now);
    }
} 
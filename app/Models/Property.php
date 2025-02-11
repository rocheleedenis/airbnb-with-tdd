<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'max_guests',
        'price_per_night',
    ];

    protected $casts = [
        'id' => 'integer',
        'max_guests' => 'integer',
        'price_per_night' => 'integer',
    ];
}

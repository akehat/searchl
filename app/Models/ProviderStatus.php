<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id',
        // 'location', // text
        'longitude', // double
        'latitude', // double
        'range', // int
        'range_format', // e.g. km
        'search_string', // ?
        'is_available' // green, orange, red
    ];
}

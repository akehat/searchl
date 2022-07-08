<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'search_string',
        'emergency',
        'longitude', // double
        'latitude', // double
        'range', // int
        'range_format', // e.g. KM / MI
    ];
}

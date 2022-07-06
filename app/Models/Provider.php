<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'profession_type',
        'first_name',
        'last_name',
        'base_location',
        'phone_number',
        'search_fields',
        'standard_work_hours',
        'emergency_availability',
        'share_exact_location',
        'website_url',
        'linkedin'
    ];
}

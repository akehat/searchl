<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderStatistics extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id',
        'search_count', // todo: search count per term (separate table)
        'top_ten',
        'calls_attempted',
        'jobs',
        'profile_view'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = [
        'lab_number',
        'priority',
        'category',
        'data',
    ];

    protected $casts = [
        'data' => 'object',
    ];
}

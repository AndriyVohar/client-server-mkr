<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'name',
        'manufacturer',
        'expiration_date',
        'price',
    ];

    protected $casts = [
        'expiration_date' => 'date',
        'price' => 'decimal:2',
    ];
}


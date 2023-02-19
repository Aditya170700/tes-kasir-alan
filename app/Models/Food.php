<?php

namespace App\Models;

use App\Traits\Uuid;
use App\Services\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Food extends Model
{
    use HasFactory, Uuid;

    protected $guarded = [];

    protected $casts = [
        'id' => 'string',
    ];

    protected $appends = [
        'foto_url',
        'idr_harga',
    ];

    protected function fotoUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => File::show($attributes['foto']),
        );
    }

    protected function idrHarga(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => 'Rp. ' . number_format($attributes['harga'], 0, '.'),
        );
    }
}

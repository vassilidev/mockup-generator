<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'pseudo',
        'name',
        'surname',
        'photo',
    ];

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => ucfirst($this->name) . ' ' . Str::upper($this->surname),
        );
    }
}

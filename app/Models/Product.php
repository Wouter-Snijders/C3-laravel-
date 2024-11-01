<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Definieer hier je fillable en andere eigenschappen
    protected $fillable = [
        'name',
        'description',
        'price',
        // Voeg hier andere relevante velden toe
    ];
}

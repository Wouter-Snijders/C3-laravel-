<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertentie extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'category', 'photo'];

    // Advertentie.php
public function user()
{
    return $this->belongsTo(User::class);
}

}



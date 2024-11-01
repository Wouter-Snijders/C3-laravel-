<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'quantity'];

    // Definieer de relatie met het Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Definieer de relatie met de User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

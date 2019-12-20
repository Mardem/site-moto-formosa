<?php

namespace App\Models\Cart;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['uuid', 'user_id'];

    /*
     * Relationships
     * */
    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }
}

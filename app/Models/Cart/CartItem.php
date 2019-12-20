<?php

namespace App\Models\Cart;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['price', 'id_product', 'attr', 'cart_id', 'quantity'];

    /*
     * Relationships
     * */

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}

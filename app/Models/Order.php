<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'firstName', 'lastName', 'zipcode', 'street', 'neighborhood',
        'city', 'uf', 'number', 'complement', 'shipping', 'totalCart',
        'productInfo'
    ];
}

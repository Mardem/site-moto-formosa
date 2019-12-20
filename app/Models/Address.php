<?php

namespace App\Models;

use App\Support\Traits\QueryGlobalScopeTrait;
use App\Support\Traits\SharedFunctions;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use QueryGlobalScopeTrait, SharedFunctions;
    protected $fillable = ['zipcode', 'street', 'neighborhood', 'city', 'uf', 'complement', 'number','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

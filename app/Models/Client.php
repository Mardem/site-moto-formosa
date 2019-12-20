<?php

namespace App\Models;

use App\Support\Traits\QueryGlobalScopeTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Spiritix\LadaCache\Database\LadaCacheTrait;

class Client extends Model
{
    use QueryGlobalScopeTrait;
//    use LadaCacheTrait;

    protected $fillable = ['name', 'cpf_cnpj', 'birthday', 'phone', 'sex', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

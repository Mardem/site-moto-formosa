<?php

namespace App\Models\Admin\Product;

use App\Support\Traits\QueryGlobalScopeTrait;
use App\Support\Traits\SharedFunctions;
use Illuminate\Database\Eloquent\Model;
use Spiritix\LadaCache\Database\LadaCacheTrait;

class DetailProduct extends Model
{
    use QueryGlobalScopeTrait;
    use SharedFunctions;
//    use LadaCacheTrait;

    protected $fillable = ['name', 'description', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

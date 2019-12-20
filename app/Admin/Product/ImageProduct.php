<?php

namespace App\Admin\Product;

use App\Support\Traits\QueryGlobalScopeTrait;
use App\Support\Traits\SharedFunctions;
use Illuminate\Database\Eloquent\Model;
use Spiritix\LadaCache\Database\LadaCacheTrait;

class ImageProduct extends Model
{
    use QueryGlobalScopeTrait;
    use SharedFunctions;

    protected $fillable = ['path', 'thumb_path', 'principal', 'product_id'];
}

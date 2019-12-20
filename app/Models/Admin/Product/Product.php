<?php

namespace App\Models\Admin\Product;

use App\Admin\Product\ImageProduct;
use App\Support\Traits\QueryGlobalScopeTrait;
use App\Support\Traits\SharedFunctions;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spiritix\LadaCache\Database\LadaCacheTrait;

class Product extends Model
{
    use QueryGlobalScopeTrait;
    use SharedFunctions;
//    use LadaCacheTrait;
    use Sluggable;

    const LOCAL = [
        0 => 'POPULAR',
        1 => 'SPECIAL',
        2 => 'DEFAULT'
    ];
    
    protected $fillable = [
        'slug', 'name', 'description', 'seo_description', 'price',
        'local', 'qtd', 'category_product_id', 'rfc', 'keywords',
        'width', 'height', 'length', 'weight', 'ml_link', 'ml_link_edit'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */
    public function getStatusAmountAttribute() // status_amount
    {
        $status = '';
        if($this->getAttribute('qtd') >= 20) {
            $status = "<span class='badge badge-success'>{$this->getAttribute('qtd')}</span>";
        } else if($this->getAttribute('qtd') <   20 && $this->getAttribute('qtd') > 5) {
            $status = "<span class='badge badge-warning'>{$this->getAttribute('qtd')}</span>";
        } else if($this->getAttribute('qtd') <= 5) {
            $status = "<span class='badge badge-danger'>{$this->getAttribute('qtd')}</span>";
        }
        return $status;
    }

    public function getLocalFormattedAttribute() // local_formatted
    {
        $local = $this->getAttribute('local');
        $txtLocal = '';
        if($local == 0) {
            $txtLocal = 'Popular';
        } else if($local == 1) {
            $txtLocal = 'Especial';
        } else {
            $txtLocal = 'Padrão';
        }
        return $txtLocal;
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_product_id');
    }

    public function details()
    {
        return $this->hasMany(DetailProduct::class);
    }

    public function images()
    {
        return $this->hasMany(ImageProduct::class);
    }
}

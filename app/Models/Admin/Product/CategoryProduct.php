<?php

namespace App\Models\Admin\Product;

use App\Support\Traits\QueryGlobalScopeTrait;
use App\Support\Traits\SharedFunctions;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Spiritix\LadaCache\Database\LadaCacheTrait;

class CategoryProduct extends Model
{
    use QueryGlobalScopeTrait;
    use SharedFunctions;
//    use LadaCacheTrait;
    use Sluggable;

    const CATEGORIES = [
        'NORMAL',
        'HOME'
    ];
    protected $fillable = ['name', 'path', 'local'];


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


    /**
     * Relationships
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Scopes
     */
    public function scopeLocation($query, $local) // local()
    {
        return $query->where('local', '=', $local);
    }
}

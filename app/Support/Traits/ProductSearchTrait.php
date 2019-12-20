<?php


namespace App\Support\Traits;


use App\Models\Admin\Product\CategoryProduct;
use App\Models\Admin\Product\Product;
use App\Support\Search\ProductSearch;

trait ProductSearchTrait
{
    public function automaticSearch($model, $relationship = null)
    {
        $search = new ProductSearch($model, $relationship);

        if (request()->has('q'))
            $products = $search->byString(request('q'));
        else if (request()->has('category'))
            $products = $search->byCategory(request('category'), 'products');
        else
            $products = $search->default();
        return $products;
    }
}

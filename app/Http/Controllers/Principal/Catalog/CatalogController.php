<?php

namespace App\Http\Controllers\Principal\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product\CategoryProduct;
use App\Models\Admin\Product\Product;
use App\Support\Traits\ProductSearchTrait;
use Ceman\Meli;

class CatalogController extends Controller
{
    use ProductSearchTrait;

    public function index()
    {
        $products = $this->automaticSearch(Product::class, CategoryProduct::class);
        return view('principal.pages.catalog.search', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', '=', $slug)->firstOrFail();
        return view('principal.pages.catalog.show-product', compact('product'));
    }
}

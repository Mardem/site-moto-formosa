<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin\Product\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function update(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->ml_link = $request->link;
        $product->ml_link_edit= $request->linkEdit;
        $product->save();
    }
}

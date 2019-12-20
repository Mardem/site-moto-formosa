<?php

namespace App\Http\Controllers\Search;

use App\Models\Admin\Product\CategoryProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function byCategory(Request $request)
    {
        $products = CategoryProduct::findOrFail($request->category)->products()->paginate();
        return view('principal.pages.catalog.search', compact('products'));
    }
}

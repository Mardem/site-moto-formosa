<?php

namespace App\Http\Controllers\Principal;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product\Product;
use Cache;

class PrincipalController extends Controller
{
    public function index()
    {
        $specialProducts = Product::where('local', '=', array_search('SPECIAL', Product::LOCAL))->with(['images', 'category:name,id'])->limit(7)->get();
        $popularProducts = Product::where('local', '=', array_search('POPULAR', Product::LOCAL))->with(['images', 'category:name,id'])->limit(8)->get();

        return view('principal.index', compact('specialProducts', 'popularProducts'));
    }
}

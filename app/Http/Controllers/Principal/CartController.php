<?php

namespace App\Http\Controllers\Principal;

use App\Models\Cart\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        $id = $_COOKIE['userKeyCommerce'];

        $items = Cart::where('uuid', $id)->firstOrFail()->items()->paginate();
        return view('principal.pages.cart', compact('items'));
    }
}

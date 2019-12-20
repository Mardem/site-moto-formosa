<?php

namespace App\Http\Controllers\User;

use App\Models\Admin\Product\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function buy()
    {
        $product = Product::findOrFail($_COOKIE['productId']);
        return view('principal.cart.buy', compact('product'));
    }

    public function secondStep(Request $request)
    {
        try {
            if($request->shipping == 0) {
                $request['shipping'] = null;
                return redirect()->back()->with('error', 'Selecione uma forma de envio')->withInput($request->all());
            }
            $request['complement'] = $request['complement'] ?? ' ';

            $order = Order::create($request->all());
            $shipping = explode(';', $order->shipping);

            $productInfo = explode(';', $order->productInfo); // [0] => Nome do produto, [1] => ID do Produto, [2] => Preço do produto, [3] => Quantidade

            return view('principal.cart.pay', compact('order', 'shipping', 'productInfo'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('success', $exception->getMessage())->withInput($request->all());
        }
    }

    public function payed(Request $request)
    {
        return $request->all();
    }
}

<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{
    public function createCart(Request $request)
    {
        $request['uuid'] = $request->key;
        $cart = Cart::create($request->all());
        return $cart;
    }

    public function getItems($token)
    {
        $cart = Cart::where('uuid', '=', $token)->firstOrFail();
        return $cart->items;
    }

    public function addItem(Request $request)
    {
        try {
            $item = CartItem::where('id_product', $request->id_product); // Busca o item no carrinho

            if($item->count() == 0) { // Se não encontrar ele, cria um novo carrinho e adiciona um item no carrinho
                $cart = Cart::where('uuid', '=', $request->token)->firstOrFail();
                $cart->items()->create($request->all());

                return response()->json([
                    'status' => 201,
                    'message' => 'Produto adicionado ao carrinho com sucesso!'
                ], 201);
            } else {
                $product = $item->first();
                $product->quantity = $product->quantity + 1;
                $product->save();

                return response()->json([
                    'status' => 201,
                    'message' => 'Produto atualizado com sucesso!'
                ], 201);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'message' => 'Não foi possível carregar esse produto ao carrinho...' . $exception->getMessage()
            ], 500);
        }
    }

    public function calculateItems($token)
    {
        $total = Cart::where('uuid', '=', $token)->firstOrFail()->items()->sum('price');
        $formatted = 'R$ ' . number_format($total, 2, ',', '.');
        return response()->json([
            'formatted' => $formatted,
            'total' => $total
        ]);
    }

    public function removeItem($id)
    {
        CartItem::findOrFail($id)->delete();
        return response()->json([
            'status' => 410,
            'message' => 'Item removido com sucesso!'
        ]);
    }
}

<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->name('api.')->group(function() {
    Route::get('calcular-frete', 'SigepController@consultCode')->name('shipping');

    # Ferramenta de carrinho
    Route::namespace('Cart')->name('cart.')->group(function() {
        Route::post('create-cart', 'CartController@createCart')->name('createCart');
        Route::get('get-items/{token}', 'CartController@getItems')->name('createItems');
        Route::post('add-item', 'CartController@addItem')->name('addItem');
        Route::get('calculate-items/{token}', 'CartController@calculateItems')->name('calculateItems');
        Route::get('remove-item/{id}', 'CartController@removeItem')->name('removeItem');
    });
    Route::post('set-link-product', 'ProductController@update');
});

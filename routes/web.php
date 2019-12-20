<?php

Route::get('home', 'RedirectController')->name('user-login');

Route::namespace('User')->middleware([])->group(function() {
    Route::resource('address', 'AddressController');
    Route::get('comprar', 'CheckoutController@buy')->name('cart.buy');
    Route::match(['get', 'post'],'finalizar-compra', 'CheckoutController@secondStep')->name('cart.secondStep');
    Route::post('save', function(\Illuminate\Http\Request $request) {
        return $request->all();
    })->name('saveCart');
});

Route::namespace('Principal')->group(function () {
    Route::get('/', 'PrincipalController@index')->name('home-site');

    Route::namespace('Catalog')->name('catalog.')->prefix('catalogo')->group(function () {
        Route::get('/', 'CatalogController@index')->name('index');
        Route::get('/{slug}', 'CatalogController@show')->name('show');
    });
});


Route::namespace('MercadoLivre')->group(function() {
    Route::get('mercadolivre', 'MLController@index');
});

// Rotas para busca
Route::namespace('Search')->name('search.')->group(function() {
    Route::get('pequisar', 'SearchController@byCategory')->name('byCategory');
});

Route::name('admin.')->prefix('admin')->middleware('auth')->group(function () {
    Route::get('dashboard', 'DashboardController')->name('dashboard');

    Route::get('users/roles', 'UserController@roles')->name('users.roles');
    Route::resource('users', 'UserController', [
        'names' => [
            'index' => 'users'
        ]
    ]);
    
    Route::namespace('Admin')->group(function () {
        Route::namespace('Control')->prefix('control')->group(function () {
            Route::resource('clients', 'ClientController');

            Route::namespace('Product')->prefix('product')->group(function () {
                Route::resource('categories-product', 'CategoryProductController');
                Route::resource('products', 'ProductController');
                Route::resource('details-product', 'DetailsProductController');
                Route::resource('images-product', 'ImageProductController');
            });
        });
    });
});

Route::middleware('auth')->get('logout', function () {
    Auth::logout();
    return redirect(route('login'))->withInfo('Sessão finalizada com sucesso!');
})->name('logout');

Auth::routes(['verify' => true]);

Route::name('js.')->group(function () {
    Route::get('dynamic.js', 'JsController@dynamic')->name('dynamic');
});

// Get authenticated user
Route::get('users/auth', function () {
    return response()->json(['user' => Auth::check() ? Auth::user() : false]);
});

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/painel', 'HomeController@redirectTo')->middleware('auth');


// Rotas Administrativas
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['auth'],
    'as' => 'admin.',
], function( $admin ) {
    $admin->resource('usuarios', UsersController::class);
    $admin->resource('categorias', ProductCategoriesController::class);
    $admin->resource('produtos', ProductsController::class);

    $admin->post('pedido/{id_pedido}/aprovar', 'OrdersController@approved');
    $admin->post('pedido/{id_pedido}/negar', 'OrdersController@denied');
});

// Rotas Publicas
Route::group([
    'prefix' => 'cliente',
    'namespace' => 'Customer',
    'as' => 'customer.'
], function( $customer ) {
    $customer->get('carrinho', 'CatalogController@shoppingCart')->name('shopping-cart');
    $customer->post('carrinho/processar-pedido', 'OrdersController@store')->name('orders.store');
    $customer->get('catalogo', 'CatalogController@index')->name('catalog');
    $customer->get('catalogo/{item_id}/adicionar-item', 'CatalogController@addItem');
    $customer->get('pedido/{pedido_id}', 'OrdersController@show');
});

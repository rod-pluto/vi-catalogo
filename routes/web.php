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
Route::get('pesquisa', 'HomeController@search');
Route::get('produto/{product_id}', 'HomeController@product');

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

    $admin->get('reordenar/produtos', 'ReorderingController@index');
    $admin->get('reordenar/produtos/categoria/{category_id}', 'ReorderingController@reorder');
    $admin->post('reordenar/produtos/categoria/{categoria_id}', 'ReorderingController@update');
    $admin->post('pedido/{id_pedido}/aprovar', 'OrdersController@approved');
    $admin->post('pedido/{id_pedido}/negar', 'OrdersController@denied');
    $admin->delete('pedido/{id_pedido}','OrdersController@delete');
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

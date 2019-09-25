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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');


// Rotas Administrativas
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.'
], function( $admin ) {
    $admin->resource('usuarios', UsersController::class);
    $admin->resource('produtos', ProductsController::class);
});

// Rotas Publicas
Route::group([
    'prefix' => 'cliente',
    'namespace' => 'Customer',
    'as' => 'customer.'
], function( $customer ) {

});

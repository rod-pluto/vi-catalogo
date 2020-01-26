<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Order\Order;

class HomeController extends Controller
{
	public function index(Request $request) {
		$orders = [];
		$dealers = [];

	    if (Auth::user()->roles[0]->name == 'admin') {
	    	$orders = Order::all();
	    	$dealers = Auth::user()->role('dealer')->get();
	    } elseif( Auth::user()->roles[0]->name == 'dealer') {
	    	$orders = Auth::user()->dealerOrders();
	    } else {
	    	$orders = Auth::user()->orders;
        }

	    if ( $request->has('dealer') ){
	        $orders = Auth::user()->dealerOrders($request->input('dealer'));
        }

	    return view('home', compact('orders', 'dealers'));
    }

    public function search(Request $request) {
	    $products = Product::where('description','LIKE' ,'%'.$request->input('menu-search-input').'%')->get();
	    return view('customer.catalog', compact('products'));
    }

    public function product($id) {
	    $product = Product::findOrFail($id);
	    return view('product', compact('product'));
    }

    public function redirectTo() {
        if (Auth::user() && Auth::user()->roles[0]->name == 'customer') {
            return redirect('/cliente/catalogo/?categoria=1');
        } else {
            return redirect('/home');
        }
    }
}

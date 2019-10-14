<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Order\Order;

class HomeController extends Controller
{
	public function index(Request $request) {
		$orders = [];

	    if (Auth::user()->roles[0]->name == 'admin') {
	    	$orders = Order::paginate(10);
	    } elseif( Auth::user()->roles[0]->name == 'company') {
	    	$orders = Auth::user()->companyOrders();
	    } else {
	    	$orders = Auth::user()->orders;
        }

	    return view('home', compact('orders'));
    }

    public function redirectTo() {
        if (Auth::user() && Auth::user()->roles[0]->name == 'customer') {
            return redirect('/cliente/catalogo/?categoria=1');
        } else {
            return redirect('/home');
        }
    }
}

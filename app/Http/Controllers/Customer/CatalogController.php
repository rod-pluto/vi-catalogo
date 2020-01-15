<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CatalogController extends Controller
{
    public function index(Request $request) {

        if ($request->has('categoria') ) {
            $products = Product::where(
                    'category_id',
                    $request->input('categoria')
                )->orderBy('order')->get();
        } else {
            $products = Product::all();
        }

        return view('customer.catalog', compact('products'));
    }

    public function addItem( $id ) {
        $product = Product::find( $id );
        return view('customer.add_item', compact('product'));
    }

    public function shoppingCart() {
        return view('customer.orders.checkout');
    }
}

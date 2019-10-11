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
            $where = ['category_id', $request->input('categoria')];
            if( Auth::user()->roles[0]->name != 'customer ') {
                $products = Auth::user()->products;
                $products = $products->where('category_id', $request->input('categoria'));
            } else {
                $products = Auth::user()->company->products;
                $products = $products->where('category_id', $request->input('categoria'));
            }
        } else {
            if( Auth::user()->roles[0]->name != 'customer ') {
                $products = Auth::user()->products;
            } else {
                $products = Auth::user()->company->products;
            }
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

<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CatalogController extends Controller
{
    public function index() {
        $products = Auth::user()->company->products;
        return view('customer.catalog', compact('products'));
    }
}

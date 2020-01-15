<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Http\Request;

class ReorderingController extends Controller
{
    public function index(){
        $categories = ProductCategory::all();
        return view('admin.reordering.index', compact('categories'));
    }

    public function reorder($categoryId) {
        $category = ProductCategory::find($categoryId);
        $products = Product::where('category_id', $categoryId)->orderBy('order')->get();
        return view('admin.reordering.reorder', compact('products', 'category'));
    }

    public function update(Request $request) {
        $ids = json_decode($request->input('orders'));
        foreach($ids as $index => $id) {
            $product = Product::find($id);
            if($product) {
                $product->order = $index;
                $product->save();
            }
        }

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Produtos reorganizados com sucesso'
        ]);
    }
}

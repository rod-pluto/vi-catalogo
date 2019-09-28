<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Repositories\Interfaces\ProductCategoryRepositoryInterface as CategoryRepository;

class ProductsController extends Controller
{
    private $product;
    private $category;

    public function __construct(
        ProductRepository $product,
        CategoryRepository $category
    ) {
        $this->product  = $product;
        $this->category = $category;
    }

    public function index() {
       
        $products = $this->product->findAll();
        $categories = $this->category->findAll();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function show( $id ) {
        $product  = $this->product->find($id);
        $categories = $this->category->findAll();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function store(StoreRequest $request) {
        /*try {
            $this->product->create( $request->except('_token') );
            return redirect()->route('admin.produtos.index')->with([
                'status' => 'success',
                'message' => 'Produto adicionado com sucesso'
            ]);
        } catch(\Exception $e) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Ocorreu algum erro no processamento. Tente novamente em alguns instantes'
            ]);
        }*/
        $this->product->create( $request->except('_token') );
            return redirect()->route('admin.produtos.index')->with([
                'status' => 'success',
                'message' => 'Produto adicionado com sucesso'
            ]);
    }

    public function update(UpdateRequest $request, $id) {
        try {
            $this->product->update( $id, $request->except('_token') );
            return redirect()->route('admin.produtos.index')->with([
                'status' => 'success',
                'message' => 'Produto atualizado com sucesso'
            ]);
        } catch(\Exception $e) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Ocorreu algum erro no processamento. Tente novamente em alguns instantes'
            ]);
        }
    }

    public function destroy(Request $request, $id) {}
}

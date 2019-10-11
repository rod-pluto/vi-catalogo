<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Repositories\Interfaces\ProductCategoryRepositoryInterface as CategoryRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

class ProductsController extends Controller
{
    private $product;
    private $category;
    private $user;

    public function __construct(
        ProductRepository $product,
        CategoryRepository $category,
        UserRepository $user
    ) {
        $this->product  = $product;
        $this->category = $category;
        $this->user = $user;
    }

    public function index() {

        $products = $this->product->findAll();
        $categories = $this->category->findAll();
        $companies = $this->user->findAllCompanies();

        return view('admin.products.index', compact('products', 'categories', 'companies'));
    }

    public function show( $id ) {
        $product  = $this->product->find($id);
        $categories = $this->category->findAll();
        $companies = $this->user->findAllCompanies();

        return view('admin.products.edit', compact('product', 'categories', 'companies'));
    }

    public function store(StoreRequest $request) {
        $data = $request->except('_token');
        $data['price'] = str_replace(",", ".",str_replace(".", "", $data['price']));
        try {
            $this->product->create( $data );
            return redirect()->route('admin.produtos.index')->with([
                'status' => 'success',
                'message' => 'Produto adicionado com sucesso'
            ]);
        } catch(\Exception $e) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Ocorreu algum erro no processamento. Tente novamente em alguns instantes'
            ]);
        }
    }

    public function update(UpdateRequest $request, $id) {
        try {
            $data = $request->except('_token');
            $data['price'] = str_replace(",", ".",str_replace(".", "", $data['price']));

            $this->product->update( $id, $data );
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

    public function ean() {
        $json = json_decode(file_get_contents('http://vi-ean.rodsouza.com.br/api/images'), true);
        return $json;
    }
}

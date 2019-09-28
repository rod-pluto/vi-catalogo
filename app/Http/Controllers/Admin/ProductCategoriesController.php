<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ProductCategory\StoreRequest;
use App\Http\Requests\ProductCategory\UpdateRequest;
use App\Repositories\Interfaces\ProductCategoryRepositoryInterface as CategoryRepository;

class ProductCategoriesController extends Controller
{
    private $category;

    public function __construct(
        CategoryRepository $category
    ) {
        $this->middleware(
            ['role:admin|company']
        );

        $this->category = $category;
    }

    public function index() {
       
        $categories = $this->category->findAll();

        return view('admin.categories.index', compact('categories'));
    }

    public function show( $id ) {
        $category = $this->category->find($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function store(StoreRequest $request) {
        try {
            $this->category->create( $request->except('_token') );
            return redirect()->route('admin.categorias.index')->with([
                'status' => 'success',
                'message' => 'Categoria adicionada com sucesso'
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
            $this->category->update( $id, $request->except('_token') );
            return redirect()->route('admin.categorias.index')->with([
                'status' => 'success',
                'message' => 'Categoria atualizada com sucesso'
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

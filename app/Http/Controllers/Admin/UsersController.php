<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    private $user;

    public function __construct(
        UserRepository $user
    ){
        $this->middleware(
            ['role:admin|company']
        );

        $this->user = $user;
    }

    public function index() {
        if (Auth::user()->roles[0]->name == 'admin') {
            $nonFilterUsers = $this->user->findAll();
            $users = [];
            foreach( $nonFilterUsers as $user ) {
                if ( !count($user->roles) ) {
                    $user->delete();
                } else if (
                    count($user->roles) &&
                    (
                        $user->roles[0]->name != 'customer' &&
                        $user->id != Auth::user()->id
                    )
                ) {
                    $users[] = $user;
                }
            }
        } else {
            $users = Auth::user()->customers;
        }

        return view('admin.users.index', compact('users'));
    }

    public function show( $id ) {
        $user = $this->user->find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function store(StoreRequest $request) {
        try {
            $this->user->create( $request->except('_token') );
            return redirect()->route('admin.usuarios.index')->with([
                'status' => 'success',
                'message' => 'Usuário adicionado com sucesso'
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
            $this->user->update( $id, $request->except('_token') );
            return redirect()->route('admin.usuarios.index')->with([
                'status' => 'success',
                'message' => 'Usuário atualizado com sucesso'
            ]);
        } catch(\Exception $e) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Ocorreu algum erro no processamento. Tente novamente em alguns instantes'
            ]);
        }
    }

    public function destroy(Request $request, $id) {
        try {
            $this->user->delete( $id );
            return redirect()->route('admin.usuarios.index')->with([
                'status' => 'success',
                'message' => 'Usuário e todos os seus dados foram apagados da base de dados'
            ]);
        } catch(\Exception $e) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Ocorreu algum erro no processamento. Tente novamente em alguns instantes'
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

class UsersController extends Controller
{
    private $user;

    public function __construct(
        UserRepository $user
    ){
        $this->user = $user;
    }

    public function index() {
        $users = $this->user->findAll();
        return view('admin.users.index', compact('users'));
    }

    public function show( $id ) {
        $user = $this->user->find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function create() {}

    public function update(Request $request, $id) {}

    public function destroy(Request $request, $id) {}
}

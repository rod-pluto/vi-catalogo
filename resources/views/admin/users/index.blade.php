@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6">
            <h4>
                Usuários do Sistema <br>
                <small>Listagem geral</small>
            </h4>
        </div>

        <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6">
            <div class="text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#userCreateModal">
                    <i class="fa fa-plus-circle"></i>
                    Novo usuário
                </button>
            </div>
        </div>
    </div>

    <br>

    <div class="card card-body">
        <table class="table table-striped table-bordered table-responsive-sm table-sm" style="width:100%">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Login</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach( $users as $user )
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->nickname }}</td>
                    <td>{{ $user->status }}</td>
                    <td class="text-right">
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-sm btn-outline-secondary editUser" id="{{ $user->id }}">
                                <i class="fa fa-edit"></i>
                                editar
                            </button>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-danger deleteUser" id="{{ $user->id}}">
                            <i class="fa fa-trash-alt fa-fw"></i>
                            apagar
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include("admin.users.create_modal")
    @include("admin.users.edit_modal")
@endsection

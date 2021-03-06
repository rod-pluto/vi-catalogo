@extends('adminlte::page')

@section('content')

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-fw fa-users"></i>
                Usuários
                <small>Listagem geral de usuários do sistema</small>
            </h3>
            <div class="box-tools pull-right">
                <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal" data-target="#addUserModal"
                >Novo usuário</button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="users-table" class="table table-condensed table-hovered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Email</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user )
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    @switch( optional(optional($user)->roles[0])->name )
                                        @case('admin')
                                            <span class="label label-primary">
                                                administrador
                                            </span>
                                        @break
                                        @case('dealer')
                                            <span class="label label-warning">
                                                representante
                                            </span>
                                        @break
                                        @case('customer')
                                            <span class="label label-default">
                                                cliente
                                            </span>
                                        @break
                                    @endswitch
                                </td>
                                <td>{{ $user->email }}</td>
                                <td class="pull-right">
                                    <div class="btn-group btn-group-xs" role="group">
                                        <button class="btn btn-default"
                                            user-id="{{ $user->id }}" data-loading-text="<i class='fa fa-fw fa-spinner'></i>Processando...."
                                            onclick="showUser({{ $user->id }}, this)"
                                        >
                                            <i class="fa fa-fw fa-eye"></i>
                                            ver
                                        </button>
                                        <button class="btn btn-default"
                                            user-id="{{ $user->id }}" data-loading-text="<i class='fa fa-fw fa-spinner'></i>Processando...."
                                            onclick="editUser({{ $user->id }}, this)"
                                        >
                                            <i class="fa fa-fw fa-edit"></i>
                                            editar
                                        </button>
                                    </div>

                                    <button class="btn btn-xs btn-danger" user-id="{{ $user->id }}" data-loading-text="<i class='fa fa-fw fa-spinner'></i>Processando...."
                                            onclick="deleteUser({{ $user->id }})"
                                        >
                                        <i class="fa fa-fw fa-trash"></i>
                                        apagar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addUserModalLabel"></h4>
                </div>

                <div class="modal-body">
                    <form action="/admin/usuarios" method="post">
                        @csrf

                        @include('admin.users._form', [
                            'user' => null,
                            'isUpdate' => false
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete user modal -->
    <form id="delete-user-form" action="/admin/usuarios/" method="POST">
        @csrf
        {{ method_field('DELETE') }}
    </form>

    @include('admin.users._modal')
@stop

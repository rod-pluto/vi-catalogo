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
                <button type="button" class="btn btn-primary">Novo usuário</button>
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
                                <td>{{ $user->roles[0]->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="pull-right">
                                    <div class="btn-group btn-group-xs" role="group">
                                        <button class="btn btn-default show-user" user-id="{{ $user->id }}">
                                            <i class="fa fa-fw fa-eye"></i>
                                            ver
                                        </button>
                                        <button class="btn btn-default edit-user" user-id="{{ $user->id }}">
                                            <i class="fa fa-fw fa-edit"></i>
                                            editar
                                        </button>
                                    </div>

                                    <button class="btn btn-xs btn-danger delete-user" user-id="{{ $user->id }}">
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

    @include('admin.users._modal')
@stop

@section('js')
    <script src="{{ asset('js/app.js?') . date('dmYHis')  }}"></script>
@stop

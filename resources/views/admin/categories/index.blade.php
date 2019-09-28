@extends('adminlte::page')

@section('content')

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-fw fa-box"></i>
                Categorias
                <small>Listagem geral de usuários do sistema</small>
            </h3>
            <div class="box-tools pull-right">
                <button 
                    type="button" 
                    class="btn btn-primary"
                    data-toggle="modal" data-target="#addCategoryModal"
                >Novo usuário</button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="categories-table" class="table table-condensed table-hovered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category )
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td class="pull-right">
                                    <div class="btn-group btn-group-xs" role="group">
                                        <button class="btn btn-default" 
                                            category-id="{{ $category->id }}" data-loading-text="<i class='fa fa-fw fa-spinner'></i>Processando...."
                                            onclick="showCategory({{ $category->id }}, this)"
                                        >
                                            <i class="fa fa-fw fa-eye"></i>
                                            ver
                                        </button>
                                        <button class="btn btn-default" 
                                            category-id="{{ $category->id }}" data-loading-text="<i class='fa fa-fw fa-spinner'></i>Processando...."
                                            onclick="editCategory({{ $category->id }}, this)"
                                        >
                                            <i class="fa fa-fw fa-edit"></i>
                                            editar
                                        </button>
                                    </div>

                                    <button class="btn btn-xs btn-danger" category-id="{{ $category->id }}" data-loading-text="<i class='fa fa-fw fa-spinner'></i>Processando....">
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
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addCategoryModalLabel">Nova Categoria</h4>
                </div>

                <div class="modal-body">
                    <form action="/admin/categorias" method="post">
                        @csrf

                        @include('admin.categories._form', [
                            'category' => null,
                            'isUpdate' => false
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.categories._modal')
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@stop

@section('js')
    <script src="{{ asset('js/app.js?') . date('dmYHis')  }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        toastr.options = {
            "positionClass": "toast-top-center",
        };

        @if( session()->has('status') && session()->has('message') )
            toastr.{{session('status')}}('{{session('message')}}');
            console.log('true');
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}');
                console.log('true');
            @endforeach
        @endif
    </script>
@stop

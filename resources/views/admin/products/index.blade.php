@extends('adminlte::page')

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-fw fa-users"></i>
                Produtos
                <small>Listagem geral de produtos do sistema</small>
            </h3>
            @hasrole('admin')
            <div class="box-tools pull-right">
                <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal" data-target="#addProductModal"
                >Novo produto</button>
            </div>
            @endhasrole
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="products-table" class="table table-condensed table-hovered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Empresa</th>
                            <th>EAN</th>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Unidade</th>
                            <th>Preço</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product )
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->company->name }}</td>
                                <td>{{ $product->ean }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name}}</td>
                                <td>{{ $product->und }}</td>
                                <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                                <td class="pull-right">
                                    <div class="btn-group btn-group-xs" role="group">
                                        <button class="btn btn-default"
                                            user-id="{{ $product->id }}" data-loading-text="<i class='fa fa-fw fa-spinner'></i>Processando...."
                                            onclick="showProduct({{ $product->id }}, this)"
                                        >
                                            <i class="fa fa-fw fa-eye"></i>
                                            ver
                                        </button>
                                        <button class="btn btn-default"
                                            user-id="{{ $product->id }}" data-loading-text="<i class='fa fa-fw fa-spinner'></i>Processando...."
                                            onclick="editProduct({{ $product->id }}, this)"
                                        >
                                            <i class="fa fa-fw fa-edit"></i>
                                            editar
                                        </button>
                                    </div>

                                    <button class="btn btn-xs btn-danger" user-id="{{ $product->id }}" data-loading-text="<i class='fa fa-fw fa-spinner'></i>Processando....">
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
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addProductModalLabel"></h4>
                </div>

                <div class="modal-body">
                    <form action="/admin/produtos" method="post">
                        @csrf

                        @include('admin.products._form', [
                            'product' => null,
                            'categories' => $categories,
                            'isUpdate' => false
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.products._modal')
    @include('admin.products._ean_modal')
@stop

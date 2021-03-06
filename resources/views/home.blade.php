@extends('adminlte::page')
@section('title', 'AdminLTE')

@section('content')
    @if( Auth::user()->roles[0]->name != 'customer')
        <div class="row">
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-boxes"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Produtos</span>
                        <span class="info-box-number">{{ count(\App\Models\Product::all()) }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Vendas/Pedidos</span>
                        <span class="info-box-number">{{ count(\App\Models\Order\Order::all()) }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Clientes</span>
                        <span class="info-box-number">{{ count(\App\Models\User::role('customer')->get()) }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
    @endif
    <div class="row">

        <style>
            .show {
              display: inline !important;
            }
        </style>

        <div class="col-xs-12">
            <div class="box box-body">
                <form class="form-inline" method="GET" action="/pesquisa">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control" name="menu-search-input" placeholder="Descrição do produto">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                </form>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Ultimos Pedidos</h3>
                    @hasrole('admin')
                    <div class="pull-right">
                        <form id="dealer-form">
                            <div class="form-group">
                                <select name="dealer" class="form-control">
                                    <option>Representante</option>
                                    @foreach( $dealers as $dealer )
                                        <option value="{{ $dealer->id }}">{{ $dealer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    @endhasrole
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-condensed table-bordered table-hover" id="orders-table">
                        <thead>
                            <tr>
                                @hasanyrole('admin|dealer')
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Email</th>
                                @endhasanyrole
                                <th>Data</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if( Auth::user()->roles[0]->name == 'dealer')
                                @foreach( $orders as $order )
                                    <tr class="@if( $order->status == 'pending') bg-warning @elseif( $order->status == 'approved') bg-success @else bg-danger @endif">
                                        @hasanyrole('admin|dealer')
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->customer->name }}</td>
                                        <td>{{ $order->customer->email }}</td>
                                        @endhasanyrole
                                        <td @if(Auth::user()->roles[0]->name=='customer') width="80%" @endif>{{ $order->updated_at->format('d-m-Y H:i:s') }}</td>
                                        <td width="10%">
                                            @switch( $order->status )
                                                @case('approved')
                                                <span class="label label-success">Aprovado</span>
                                                @break
                                                @case('pending')
                                                <span class="label label-warning">Pendente</span>
                                                @break
                                                @case('denied')
                                                <span class="label label-danger">Negado</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-xs btn-default" onclick="toggleOrderInfo({{ $order->id }})">
                                                <i id="btn-toggle-icon" class="fa fa-fw fa-plus"></i>
                                                info
                                            </button>
                                            @hasanyrole('admin|dealer')
                                            @if( $order->status == 'pending')
                                                <form method="post" action="/admin/pedido/{{$order->id}}/aprovar" style="float:right">
                                                    @csrf
                                                    <button class="btn btn-xs btn-success">
                                                        <i id="btn-toggle-icon" class="fa fa-fw fa-check"></i>
                                                        aprovar
                                                    </button>
                                                </form>
                                                <form method="post" action="/admin/pedido/{{$order->id}}/negar" style="float:right">
                                                    @csrf
                                                    <button class="btn btn-xs btn-danger">
                                                        <i id="btn-toggle-icon" class="fa fa-fw fa-exclamation"></i>
                                                        negar
                                                    </button>
                                                </form>
                                            @endif
                                            <form method="post" action="/admin/pedido/{{$order->id}}" style="float:right">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-xs btn-danger">
                                                    <i id="btn-toggle-icon" class="fa fa-fw fa-trash"></i>
                                                    apagar
                                                </button>
                                            </form>
                                            @endhasanyrole
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                @foreach( $orders as $order )
                                    <tr class="@if( $order->status == 'pending') bg-warning @elseif( $order->status == 'approved') bg-success @else bg-danger @endif">
                                        @hasanyrole('admin|dealer')
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->customer->name }}</td>
                                        <td>{{ $order->customer->email }}</td>
                                        @endhasanyrole
                                        <td @if(Auth::user()->roles[0]->name=='customer') width="80%" @endif>{{ $order->updated_at->format('d-m-Y H:i:s') }}</td>
                                        <td width="10%">
                                            @switch( $order->status )
                                                @case('approved')
                                                    <span class="label label-success">Aprovado</span>
                                                    @break
                                                @case('pending')
                                                    <span class="label label-warning">Pendente</span>
                                                    @break
                                                @case('denied')
                                                    <span class="label label-danger">Negado</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td class="text-center" width="25%">
                                            <button class="btn btn-xs btn-default" onclick="toggleOrderInfo({{ $order->id }})">
                                                <i id="btn-toggle-icon" class="fa fa-fw fa-plus"></i>
                                                info
                                            </button>
                                            @hasanyrole('admin|dealer')
                                                @if( $order->status == 'pending')
                                                    <form method="post" action="/admin/pedido/{{$order->id}}/aprovar" style="float:right">
                                                        @csrf
                                                        <button class="btn btn-xs btn-success">
                                                            <i id="btn-toggle-icon" class="fa fa-fw fa-check"></i>
                                                            aprovar
                                                        </button>
                                                    </form>
                                                    <form method="post" action="/admin/pedido/{{$order->id}}/negar" style="float:right">
                                                        @csrf
                                                        <button class="btn btn-xs btn-danger">
                                                            <i id="btn-toggle-icon" class="fa fa-fw fa-exclamation"></i>
                                                            negar
                                                        </button>
                                                    </form>
                                                @endif
                                                <form method="post" action="/admin/pedido/{{$order->id}}" style="float:right">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-xs btn-danger">
                                                        <i id="btn-toggle-icon" class="fa fa-fw fa-trash"></i>
                                                        apagar
                                                    </button>
                                                </form>
                                            @endhasanyrole
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    @include('admin.products._modal')
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
    <script>
        $('#orders-table').DataTable({
            language: {
                'url': 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json'
            },
            "order": [[ 0, "desc" ]]
        });

        $('#dealer-form select[name="dealer"]').change(function(){
            $('#dealer-form').submit();
        });

        function toggleOrderInfo ( order_id ){
            const url = '/cliente/pedido';
            const modal = $('#genericModal');

            $.get(url + '/' + order_id)
                .done(function( response ) {
                    console.log(url);
                    $('#genericModal .modal-body').html( response );
                    modal.modal('show');
                })
                .fail(function( response ) {
                    console.log(url);
                    console.log( response );
                    alert( 'deu tiuti' );
                });
        }
    </script>
@stop

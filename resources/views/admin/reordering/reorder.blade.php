@extends('adminlte::page')

@section('content')

    <style>
        #sortable { list-style-type: none; margin: 0; padding: 0; }
        #sortable li { margin: 3px 3px 3px 0; padding: 1px; float: left; width: 200px; height: 210px; text-align: center; }
    </style>

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-fw fa-sort"></i>
                Reordenar produtos em {{ $category->name }}
                <small>Ajustar ordem dos produtos dentro de suas categorias</small>
            </h3>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body text-center">
            <ul class="list-group" id="sortable">
                @foreach ($products as $product)
                    <li class="list-group-item" id="{{ $product->id }}">
                        <div class="thumbnail">
                            <img src="{{ $product->image }}" alt="...">
                        </div>
                        {{ $product->name }} - {{ $product->ean }}
                    </li>
                @endforeach
            </ul>

            <button id="btn-reordenar" class="btn btn-success">Reordenar</button>
        </div>

        <form id="reorder-form" action="/admin/reordenar/produtos/categoria/{{ $category->id }}" method="post">
            @csrf
            <input id="orders" type="hidden" name="orders">
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@stop

@section('js')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#sortable" ).sortable();
            $( "#sortable" ).disableSelection();

            $('#btn-reordenar').click(function(evt) {
                $('#orders').val(JSON.stringify($('#sortable').sortable('toArray')));
                $( "#sortable" ).sortable('refreshPositions');
                $('#reorder-form').submit();
            });
        } );
    </script>
@stop

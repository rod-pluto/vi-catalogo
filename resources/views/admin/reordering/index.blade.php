@extends('adminlte::page')

@section('content')

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-fw fa-sort"></i>
                Reordenar produtos
                <small>Ajustar ordem dos produtos dentro de suas categorias</small>
            </h3>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <ul class="list-group">
                @foreach ($categories as $category)
                    <li class="list-group-item"><a href="/admin/reordenar/produtos/categoria/{{ $category->id }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
@stop

@extends('adminlte::page')

@section('content')

    <div class="row">
        @foreach( $products as $product )
        <div class="col-xs-4 col-sm-4 col-md-2">
            <div class="thumbnail text-center">
                <img src="{{ $product->image }}" alt="...">
                <h4>{{ $product->name }}</h4>
            </div>
        </div>
        @endforeach
    </div>

@stop
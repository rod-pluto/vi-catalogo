@extends('adminlte::page')

@section('content')

    <div class="row">
        @foreach( $products as $product )
        <div class="col-xs-4 col-sm-4 col-md-2">
            <div class="thumbnail text-center" onclick="modalAddItem({{ $product->id }})">
                <img src="{{ $product->image }}" alt="...">
                <h5><i>{{ $product->ean }}</i></h5>
                <h5>{{ $product->name }}</h5>
            </div>
        </div>
        @endforeach
    </div>

    @include('customer._modal')
@stop

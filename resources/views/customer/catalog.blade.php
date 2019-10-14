@extends('adminlte::page')

@section('content')

    <div class="row">
        @foreach( $products as $product )
            <div class="col-xs-6 col-sm-4 col-md-2 text-center">
                <div class="thumbnail" onclick="modalAddItem({{ $product->id }})">
                    <img src="{{ $product->image }}" alt="...">
                    <div class="prod-box-info">
                        <h5 style="color:brown">
                            <b>{{ $product->name }}</b>
                        </h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @include('customer._modal')
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?{{ date('YmdHis') }}">
@stop

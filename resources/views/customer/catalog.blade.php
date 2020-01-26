@extends('adminlte::page')

@section('content')

    <div class="row">
        @foreach( $products as $product )
            <div class="col-xs-6 col-sm-4 col-md-2 text-center">
                <div class="thumbnail" @if(Auth::user()->roles[0]->name != 'admin') onclick="modalAddItem({{ $product->id }})" @endif>
                    <img src="{{ $product->image }}" alt="...">
                    <div class="prod-box-info">
                        <h5>
                            {{ $product->name }}
                            <small>R$ {{ number_format($product->price, 2, ',', '') }}</small>
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

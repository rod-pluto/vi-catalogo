@extends('adminlte::page')

@section('content')
<div id="checkout-table" class="box box-default">
    <form name="checkout-form" id="checkout-form" method="POST" action="{{ route('customer.orders.store') }}">
        @csrf
        <div class="box-body">
            @if( Auth::user()->roles[0]->name == 'dealer' )
                <div class="row">
                    <div class="form-group col-md-3 col-sm-3">
                        <label for="customer_id">Cliente</label>
                        <select class="form-control" name="customer_id" required>
                            @foreach ( Auth::user()->customers as $customer )
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif

            <table id="cart" class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th style="width:50%">Produto</th>
                        <th style="width:10%">Preço</th>
                        <th style="width:8%">Quantidade</th>
                        <th style="width:22%" class="text-center">Subtotal</th>
                        <th style="width:10%"></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr class="visible-xs">
                        <td colspan="3"></td>
                        <td colspan="1" class="text-center">
                            <strong class="total-price"></strong>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="btn btn-warning" onclick="javascript:history.back()">
                                <i class="fa fa-angle-left"></i>
                                Voltar
                            </button>
                        </td>
                        <td colspan="2"></td>
                        <td class="visible-xs"></td>
                        <td class="hidden-xs text-center"><strong class="total-price"></strong></td>
                        <td>
                            <button type="button" id="process-order-button" onclick="processOrder()" class="btn btn-success btn-block disabled" disabled>
                                Finalizar <i class="fa fa-angle-right"></i>
                            </button>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </form>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
@stop

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function approved( $id ) {
        $order = Order::find($id);
        if ( $order ) {
            $order->status = 'approved';
            $order->save();
            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Ordem de pedido #'.$order->id.' para cliente '.$order->customer->name.' aprovada.'
            ]);
        } else {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Ocorreu algum erro no processamento. Tente novamente em alguns instantes'
            ]);
        }
    }

    public function denied( $id ) {
        $order = Order::find($id);
        if ( $order ) {
            $order->status = 'denied';
            $order->save();
            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Ordem de pedido #'.$order->id.' para cliente '.$order->customer->name.' negada.'
            ]);
        } else {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Ocorreu algum erro no processamento. Tente novamente em alguns instantes'
            ]);
        }
    }

    public function delete($id) {
        $order = Order::find($id);
        foreach( $order->items as $item ) {
            $item->delete();
        }
        $order->delete();

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Ordem de pedido apagada da base de dados'
        ]);
    }
}

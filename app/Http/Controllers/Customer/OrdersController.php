<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Order\Order;
use App\Models\Order\Item;

class OrdersController extends Controller
{
    public function show( $id ) {
        $order = Order::findOrFail($id);
        $total=0;
        foreach ( $order->items as $item ) {$total += ($item->quantity * $item->product->price);}
        return view('customer.order_detail', compact('order', 'total'));
    }

    public function store(Request $request) {

    	$items = $request->input('items');
    	$quantities = $request->input('quantity');

    	if ( count($items) ) {
            $order = Order::create([
                'customer_id' => Auth::user()->id
            ]);

    		foreach($items as $index => $item) {
    			// items
    			Item::create([
    				'order_id' => $order->id,
    				'product_id' => $item,
    				'quantity' => $quantities[$index]
    			]);
    		}

    		return redirect('/home')->with([
                'status' => 'success',
                'message' => 'Pedido realizado com sucesso. Aguarde aprovação do mesmo'
            ]);
    	}

    }
}

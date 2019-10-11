<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\Order\Order;

class Item extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity'];

    public function order() {
    	return $this->belongsTo(Orders::class, 'order_id');
    }
    public function product() {
    	return $this->belongsTo(Product::class, 'product_id');
    }
}

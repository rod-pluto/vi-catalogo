<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Order\Item;

class Order extends Model
{
    protected $fillable = ['customer_id', 'status'];

    public function customer() {
    	return $this->belongsTo(User::class, 'customer_id');
    }

    public function items() {
    	return $this->hasMany(Item::class, 'order_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

use App\Models\Users;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'customer_id', 'dealer_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Usuario representante terá VARIOS CLIENTES
     */
    public function customers() {
        return $this->hasMany(User::class, 'dealer_id');
    }

    /**
     * Usuario cliente será associado a uma companhia
     */
    public function dealer() {
        return $this->belongsTo(User::class, 'company_id');
    }


    public function orders() {
        return $this->hasMany(Order\Order::class, 'customer_id');
    }

    public function dealerOrders( $id=null ) {
        $orders = [];

        if ( $id != null ) {
            $customers = User::where('dealer_id', $id)->get();
            foreach( $customers as $customer ) {
                if ( count($customer->orders) )
                    foreach ($customer->orders as $order)
                        $orders[] = $order;
            }
        } else {
            foreach( $this->customers as $customer ) {
                if ( count($customer->orders) )
                    foreach ($customer->orders as $order)
                        $orders[] = $order;
            }
        }

        return count($orders) ? $orders : [];
    }
}

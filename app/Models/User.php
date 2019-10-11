<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

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
        'name', 'email', 'password',
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
     * Usuario companhia terá VARIOS CLIENTES
     */
    public function customers() {
        return $this->hasMany(User::class, 'company_id');
    }

    /**
     * Usuario cliente será associado a uma companhia
     */
    public function company() {
        return $this->belongsTo(User::class, 'company_id');
    }

    /**
     * Produtos relacionados
     */
    public function products() {
        return $this->hasMany(Product::class, 'company_id');
    }

    public function orders() {
        return $this->hasMany(Order\Order::class, 'customer_id');
    }

    public function companyOrders() {
        $orders = [];

        foreach( $this->customers as $customer ) {

            if ( count($customer->orders) )
                $orders[] = $customer->orders;
        }

        return $orders[0];
    }
}

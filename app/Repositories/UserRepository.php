<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Order\Order;
use App\Repositories\Interfaces\UserRepositoryInterface as UserInterface;

class UserRepository extends BaseRepository implements UserInterface {
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function create( array $data ): User {
        $data['password'] = Hash::make( $data['password'] );
        unset($data['password_confirmation']);

        $user = $this->model->create( $data );
        $user->assignRole( $data['role'] );

        return $user;
    }

    public function update($id, array $data): User {
        $user = $this->model->findOrFail($id);

        if ( $user ) {

            if ( $data['email'] == $user->email ){
                unset($data['email']);
            }
            if ( $data['password'] == null ) {
                unset($data['password']);
            } else {
                $data['password'] = Hash::make( $data['password'] );
            }

            unset($data['password_confirmation']);

            $user->fill( $data );
            $user->syncRoles($data['role']);

            $user->save();
        }

        return $user;
    }

    public function delete( int $id ):bool {
        $entity = $this->model->findOrFail( $id );

        $role = $entity->roles[0]->name;

        switch( $role ) {
            case 'dealer':
                if ( $entity->customers ) {
                    $customers = $entity->customers;
                    foreach ($customers as $customer) {
                        if ( count($customer->orders ) ) {
                            foreach( $customer->orders as $order ){
                                foreach($order->items as $item) {
                                    $item->delete();
                                }
                                $order->delete();
                            }
                        }
                        $customer->delete();
                    }
                }
                break;

            case 'customer':
                if ( count($entity->orders ) ) {
                    foreach( $entity->orders as $order ){
                        foreach($order->items as $item) {
                            $item->delete();
                        }
                        $order->delete();
                    }
                }
                break;
        }

        if( $entity->delete() ){
            return true;
        }

        return false;
    }

    public function findAllDealers()
    {
        return $this->model->role('dealer')->get();
    }
}

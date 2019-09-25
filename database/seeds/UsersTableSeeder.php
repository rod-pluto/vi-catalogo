<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Criacao do usuario GLOBAL
        factory(App\Models\User::class, 3)->create()->each(function ($user) {
            $user->assignRole('admin');
        });;

        // Criacao dos usuarios EMPRESA
        factory(App\Models\User::class, 10)->states('company')->create()->each(function ($user) {
            $user->assignRole('company');
            // cada empresa terá 150 clientes
            factory(App\Models\User::class, 150)->create()->each(function( $customer ) use( $user ) {
                $customer->assignRole('customer');
                $customer->company_id = $user->id;
                $customer->save();
            });
        });
    }
}

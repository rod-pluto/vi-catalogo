<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        $admin    = Role::create(['name' => 'administrator']);
        $customer = Role::create(['name' => 'customer']); // cliente
        $salesman = Role::create(['name' => 'salesman']); // vendedor | empresa
        
        factory(App\Models\User::class, 100)->create()->each(function ($user) {
            $user->assignRole("customer");
            $user->save();
        });

        factory(App\Models\User::class, 2)->create()->each(function ($user) {
            $user->assignRole("salesman");
            $user->save();
        });

        factory(App\Models\User::class, 1)->create()->each(function ($user) {
            $user->assignRole("administrator");
            $user->save();
        });
    }
}

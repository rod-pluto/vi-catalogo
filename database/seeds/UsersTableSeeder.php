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
        factory(App\Models\User::class, 1)->create()->each(function ($user) {
            $user->assignRole('admin');
        });
    }
}

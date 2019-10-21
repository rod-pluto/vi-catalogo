<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DealerRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Administrador Geral
        $dealerRole = Role::create([
            'name' => 'dealer'
        ]);
    }
}

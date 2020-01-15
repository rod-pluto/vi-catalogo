<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Administrador Geral
        $adminRole = Role::create([
            'name' => 'admin'
        ]);

        // Usuário Empresa/Distribuidor/
        $companyRole = Role::create([
            'name' => 'company'
        ]);

        // Usuário Funcionario/Empresa

        $dealerRole = Role::create([
            'name' => 'dealer'
        ]);

        // Usuário Comerciante/Lojista/Cliente Geral
        $customerRole = Role::create([
            'name' => 'customer'
        ]);
    }
}

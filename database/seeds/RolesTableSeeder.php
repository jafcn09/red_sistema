<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(RolesTableSeeder::class);

        Role::create([
            'id'            =>  '1',
            'name'          =>  'admin',
            'slug'          =>  'users.index',
            'description'   =>  'Lista y navega todas las funciones del sistema',
            'special'       =>  'all-access',
        ]);
        Role::create([
            'id'            =>  '2',
            'name'          =>  'EMPLEADO',
            'slug'          =>  'empleados.show',
            'description'   =>  'Ver detalle de clientes del sistema',
        ]);
        Role::create([
            'id'            =>  '3',
            'name'          =>  'CLIENTE',
            'slug'          =>  'clientes.edit',
            'description'   =>  'Ver detalle de clientes del sistema',
        ]);
    }
}

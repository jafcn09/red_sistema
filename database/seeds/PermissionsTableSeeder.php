<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(PermissionsTableSeeder::class);
        //Usuarios
        Permission::create([
            'name'          =>  'Navegar usuarios',
            'slug'          =>  'users.index',
            'description'   =>  'Lista y navega todos los usuarios del sistema',
        ]);
        Permission::create([
            'name'          =>  'Ver detalle del usuario',
            'slug'          =>  'users.show',
            'description'   =>  'Ver detalle de usuarios del sistema',
        ]);
        Permission::create([
            'name'          =>  'Edicion de usuarios',
            'slug'          =>  'users.edit',
            'description'   =>  'Edicion de usuarios del sistema',
        ]);
        Permission::create([
            'name'          =>  'Eliminar usuarios',
            'slug'          =>  'users.destroy',
            'description'   =>  'Eliminar los usuarios del sistema',
        ]);
        //Roles
        Permission::create([
            'name'          =>  'Crear roles',
            'slug'          =>  'roles.store',
            'description'   =>  'Lista y navega todos los roles del sistema',
        ]);
        Permission::create([
            'name'          =>  'Navegar roles',
            'slug'          =>  'roles.index',
            'description'   =>  'Lista y navega todos los roles del sistema',
        ]);
        Permission::create([
            'name'          =>  'Ver detalle del roles',
            'slug'          =>  'roles.show',
            'description'   =>  'Ver detalle de roles del sistema',
        ]);
        Permission::create([
            'name'          =>  'Edicion de roles',
            'slug'          =>  'roles.edit',
            'description'   =>  'Edicion de roles del sistema',
        ]);
        Permission::create([
            'name'          =>  'Eliminar roles',
            'slug'          =>  'roles.destroy',
            'description'   =>  'Eliminar los roles del sistema',
        ]);
        //Productos
        Permission::create([
            'name'          =>  'Crear productos',
            'slug'          =>  'productos.store',
            'description'   =>  'Lista y navega todos los productos del sistema',
        ]);
        Permission::create([
            'name'          =>  'Navegar productos',
            'slug'          =>  'productos.index',
            'description'   =>  'Lista y navega todos los productos del sistema',
        ]);
        Permission::create([
            'name'          =>  'Ver detalle del productos',
            'slug'          =>  'productos.show',
            'description'   =>  'Ver detalle de productos del sistema',
        ]);
        Permission::create([
            'name'          =>  'Edicion de productos',
            'slug'          =>  'productos.edit',
            'description'   =>  'Edicion de productos del sistema',
        ]);
        Permission::create([
            'name'          =>  'Eliminar productos',
            'slug'          =>  'productos.destroy',
            'description'   =>  'Eliminar los productos del sistema',
        ]);
    }
}

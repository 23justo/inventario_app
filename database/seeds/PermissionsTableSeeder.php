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
         //users
         Permission::create([
            'name'          => 'Crear usuarios',
            'slug'          => 'users.store',
            'description'   => 'Crear usuarios del sistema',
        ]);

        Permission::create([
            'name'          => 'Mostrar usuarios',
            'slug'          => 'users.index',
            'description'   => 'Lista  todos los usuarios del sistema',
        ]);

        Permission::create([
            'name'          => 'Modificar usuarios',
            'slug'          => 'users.update',
            'description'   => 'Modificar todos los usuarios del sistema',
        ]);

        Permission::create([
            'name'          => 'Borrar usuarios',
            'slug'          => 'users.destroy',
            'description'   => 'Borrar todos los usuarios del sistema',
        ]);

        //roles
        Permission::create([
            'name'          => 'Crear roles',
            'slug'          => 'roles.store',
            'description'   => 'Crear roles del sistema',
        ]);

        Permission::create([
            'name'          => 'Mostrar roles',
            'slug'          => 'roles.index',
            'description'   => 'Lista  todos los roles del sistema',
        ]);

        Permission::create([
            'name'          => 'Modificar roles',
            'slug'          => 'roles.update',
            'description'   => 'Modificar todos los roles del sistema',
        ]);

        Permission::create([
            'name'          => 'Borrar roles',
            'slug'          => 'roles.destroy',
            'description'   => 'Borrar todos los roles del sistema',
        ]);

        //productos
        Permission::create([
            'name'          => 'Crear productos',
            'slug'          => 'producto.store',
            'description'   => 'Crear productos del sistema',
        ]);

        Permission::create([
            'name'          => 'Mostrar productos',
            'slug'          => 'producto.index',
            'description'   => 'Lista  todos los productos del sistema',
        ]);

        Permission::create([
            'name'          => 'Modificar productos',
            'slug'          => 'producto.update',
            'description'   => 'Modificar todos los productos del sistema',
        ]);

        Permission::create([
            'name'          => 'Borrar productos',
            'slug'          => 'producto.destroy',
            'description'   => 'Borrar todos los productos del sistema',
        ]);

        //categorias
        Permission::create([
            'name'          => 'Crear categorias',
            'slug'          => 'categoria.store',
            'description'   => 'Crear categorias del sistema',
        ]);

        Permission::create([
            'name'          => 'Mostrar categorias',
            'slug'          => 'categoria.index',
            'description'   => 'Lista  todos los categorias del sistema',
        ]);

        Permission::create([
            'name'          => 'Modificar categorias',
            'slug'          => 'categoria.update',
            'description'   => 'Modificar todos los categorias del sistema',
        ]);

        Permission::create([
            'name'          => 'Borrar categorias',
            'slug'          => 'categoria.destroy',
            'description'   => 'Borrar todos los categorias del sistema',
        ]);

        //supermercados
        Permission::create([
            'name'          => 'Crear supermercados',
            'slug'          => 'supermercado.store',
            'description'   => 'Crear supermercados del sistema',
        ]);

        Permission::create([
            'name'          => 'Mostrar supermercados',
            'slug'          => 'supermercado.index',
            'description'   => 'Lista  todos los supermercados del sistema',
        ]);

        Permission::create([
            'name'          => 'Modificar supermercados',
            'slug'          => 'supermercado.update',
            'description'   => 'Modificar todos los supermercados del sistema',
        ]);

        Permission::create([
            'name'          => 'Borrar supermercados',
            'slug'          => 'supermercado.destroy',
            'description'   => 'Borrar todos los supermercados del sistema',
        ]);

        //sucursales
        Permission::create([
            'name'          => 'Crear sucursales',
            'slug'          => 'sucursale.store',
            'description'   => 'Crear sucursales del sistema',
        ]);

        Permission::create([
            'name'          => 'Mostrar sucursales',
            'slug'          => 'sucursale.index',
            'description'   => 'Lista  todos los sucursales del sistema',
        ]);

        Permission::create([
            'name'          => 'Modificar sucursales',
            'slug'          => 'sucursale.update',
            'description'   => 'Modificar todos los sucursales del sistema',
        ]);

        Permission::create([
            'name'          => 'Borrar sucursales',
            'slug'          => 'sucursale.destroy',
            'description'   => 'Borrar todos los sucursales del sistema',
        ]);

        //compras
        Permission::create([
            'name'          => 'Crear compras',
            'slug'          => 'compra.store',
            'description'   => 'Crear compras del sistema',
        ]);

        Permission::create([
            'name'          => 'Mostrar compras',
            'slug'          => 'compra.index',
            'description'   => 'Lista  todos los compras del sistema',
        ]);

        Permission::create([
            'name'          => 'Modificar compras',
            'slug'          => 'compra.update',
            'description'   => 'Modificar todos los compras del sistema',
        ]);

        Permission::create([
            'name'          => 'Borrar compras',
            'slug'          => 'compra.destroy',
            'description'   => 'Borrar todos los compras del sistema',
        ]);

         //ventas
         Permission::create([
            'name'          => 'Crear ventas',
            'slug'          => 'venta.store',
            'description'   => 'Crear ventas del sistema',
        ]);

        Permission::create([
            'name'          => 'Mostrar ventas',
            'slug'          => 'venta.index',
            'description'   => 'Lista  todos los ventas del sistema',
        ]);

        Permission::create([
            'name'          => 'Modificar ventas',
            'slug'          => 'venta.update',
            'description'   => 'Modificar todos los ventas del sistema',
        ]);

        Permission::create([
            'name'          => 'Borrar ventas',
            'slug'          => 'venta.destroy',
            'description'   => 'Borrar todos los ventas del sistema',
        ]);
    }
}

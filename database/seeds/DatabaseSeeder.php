<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(SupermercadoTableSeeder::class);
        $this->call(SucursalTableSeeder::class);
        $this->call(CategoriaTableSeeder::class);
        $this->call(ProveedorTableSeeder::class);
        $this->call(ProductoTableSeeder::class);
    }
}

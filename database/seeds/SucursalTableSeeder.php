<?php

use Illuminate\Database\Seeder;

class SucursalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Sucursal::class, 20)->create();
    }
}

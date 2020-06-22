<?php

use Illuminate\Database\Seeder;

class SupermercadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Supermercado::class, 3)->create();
    }
}

<?php

use Illuminate\Database\Seeder;
use sisControl\Vehiculo;

class VehiculosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Vehiculo::class,15)->create();
    }
}

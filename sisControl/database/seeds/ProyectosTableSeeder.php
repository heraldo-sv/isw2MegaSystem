<?php

use Illuminate\Database\Seeder;
use sisControl\Proyecto;

class ProyectosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Proyecto::class,10)->create();
    }
}

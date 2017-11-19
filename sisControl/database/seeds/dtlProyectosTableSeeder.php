<?php

use Illuminate\Database\Seeder;
use sisControl\dtlProyecto;

class dtlProyectosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(dtlProyecto::class,10)->create();
    }
}

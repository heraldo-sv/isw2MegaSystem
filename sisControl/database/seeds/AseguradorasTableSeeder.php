<?php

use Illuminate\Database\Seeder;
use sisControl\Aseguradora;

class AseguradorasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Aseguradora::class,55)->create();
    }
}

<?php

use Illuminate\Database\Seeder;
use sisControl\Repuesto;

class RepuestosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Repuesto::class,50)->create();
    }
}

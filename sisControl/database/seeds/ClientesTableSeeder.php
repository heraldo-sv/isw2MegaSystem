<?php

use Illuminate\Database\Seeder;
use sisControl\Cliente;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Cliente::class,1000)->create();
    }
}

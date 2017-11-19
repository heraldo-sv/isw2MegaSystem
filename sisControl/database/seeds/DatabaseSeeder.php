<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AseguradorasTableSeeder::class);
        $this->call(ClientesTableSeeder::class);
        $this->call(ProyectosTableSeeder::class);
        $this->call(dtlProyectosTableSeeder::class);
        $this->call(VehiculosTableSeeder::class);
        $this->call(RepuestosTableSeeder::class);
    }
}

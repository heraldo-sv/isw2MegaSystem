<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(sisControl\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(sisControl\Aseguradora::class, function (Faker\Generator $faker) {
    return [
        'nombre' => $faker->name,
        'descripcion' => $faker->sentence,
    ];
});

$factory->define(sisControl\Cliente::class, function (Faker\Generator $faker) {
    return [
        'nombre' => $faker->name,
        'apellido' => $faker->lastName,
        'documento' => $faker->randomDigitNotNull,
        'correo' => $faker->email,
        'telefono' => $faker->phoneNumber,
    ];
});

$factory->define(sisControl\Proyecto::class, function (Faker\Generator $faker) {
    return [
        'titulo' => $faker->name,
        'cliente' => $faker->year,
        'vehiculo' => $faker->year,
        'descripcion' => $faker->sentence,
        'progreso' => 1,
        'estado' => 1
    ];
});

$factory->define(sisControl\dtlProyecto::class, function (Faker\Generator $faker) {
    return [
        'proyecto'    => $faker->year,
        'user'        => $faker->year,
        'titulo'      => $faker->name,
        'etapa'       => 1,
        'descripcion' => $faker->sentence
    ];
});

$factory->define(sisControl\Vehiculo::class, function (Faker\Generator $faker) {
    return [
        'cliente'       => $faker->year,
        'placa'         => $faker->randomDigitNotNull,
        'marca'         => $faker->city,
        'modelo'        => $faker->buildingNumber,
        'anio'          => $faker->year,
        'aseguradora'   => $faker->year,
        'complemento'   => $faker->sentence,
        'comentario'    => $faker->sentence,
        'estado'        => 1
    ];
});

$factory->define(sisControl\Repuesto::class, function (Faker\Generator $faker){
    return [
        'nombre'        => $faker->name,
        'descripcion'   => $faker->sentence,
        'proveedor'     => $faker->year,
        'valor'         => $faker->year,
        'estado'        => 1
    ];
});
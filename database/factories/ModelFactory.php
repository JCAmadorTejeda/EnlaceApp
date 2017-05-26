<?php

use App\User;
use App\RequestStatus;
use App\InstallRequest;

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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'id_employee' => $faker->numberBetween(1000, 3000),
        'password' => $password ?: $password = bcrypt('secret'),
        'api_key' => User::generarToken(),
        'admin' => $faker->randomElement([User::USUARIO_ADMINISTRADOR, User::USUARIO_NO_ADMINISTRADOR]),
        'status' => '1',
    ];
});

$factory->define(RequestStatus::class, function (Faker\Generator $faker) {

    return [
        'nombre' => $faker->word,
    ];
});

$factory->define(InstallRequest::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'id_employee' => User::inRandomOrder()->first()->id_employee,
        'id_status' => RequestStatus::inRandomOrder()->first()->id_status,
        'numero_os' => $faker->numberBetween(100, 200),
        'estado' =>  $faker->name,
        'ciudad' =>  $faker->name,
        'colonia' =>  $faker->name,
        'calle' =>  $faker->name,
        'numero' => $faker->numberBetween(1, 10000),
        'latitud' => $faker->numberBetween(100000, 900000),
        'longitud' => $faker->numberBetween(100000, 900000),
        'img_ruta' => $faker->randomElement(['1.jpg','2.jpg','3.jpg']),
    ];
});

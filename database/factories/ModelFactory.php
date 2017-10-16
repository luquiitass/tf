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

use App\Models\User;

$factory->define(User::class, function (Faker\Generator $faker) {
    $dni = $faker->creditCardNumber();
    return [
        'nombre' => $faker->name,
        'apellido' => $faker->name,
        'dni' =>$dni,
        'fecha_nacimiento' => $faker->dateTimeThisDecade,
        'email' => $faker->safeEmail,
        'password' => bcrypt($dni),
        'remember_token' => str_random(10),
    ];
});

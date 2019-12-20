<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    $rand = rand(0, 1);
    return [
        'name' => $faker->name,
        'cpf_cnpj' => $faker->randomNumber(9),
        'birthday' => $faker->date('Y-m-d', now()),
        'sex' => $rand == 0 ? 'M' : 'F',
        'phone' => $faker->randomNumber(4)
    ];
});

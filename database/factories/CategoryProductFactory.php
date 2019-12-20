<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin\Product\CategoryProduct;
use Faker\Generator as Faker;

$factory->define(CategoryProduct::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'slug' => $faker->slug(4)
    ];
});

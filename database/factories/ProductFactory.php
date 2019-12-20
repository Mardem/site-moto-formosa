<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin\Product\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $promocionalPrice = rand(0, 1);
    $words = $faker->words(10);
    $split = '';

    foreach($words as $key => $word) {
        $key == 0 ? $split = $split . $word : $split = $split . ',' . $word;
    }
    return [
        'name' => $faker->name,
        'slug' => $faker->slug(5),
        'description' => $faker->randomHtml(8),
        'seo_description' => $faker->text(156),
        'price' => $faker->randomFloat(2, 3, 99),
        'local' => rand(0, 2),
        'qtd' => rand(0, 60),
        'keywords' => $split,
        'promotional_price' => $promocionalPrice == 0 ? null : $faker->randomFloat(2, 3, 99),
        'rfc' => \Illuminate\Support\Str::random(5),
        'width' => $faker->randomFloat(1, 0, 60),
        'height' => $faker->randomFloat(1, 0, 60),
        'length' => $faker->randomFloat(1, 0, 60),
        'weight' => $faker->randomFloat(1, 0, 60),
    ];
});

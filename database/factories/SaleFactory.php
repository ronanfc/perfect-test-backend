<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sale;
use Faker\Generator as Faker;

$factory->define(Sale::class, function (Faker $faker) {
    return [
        'product_id' => function () {
            return App\Product::inRandomOrder()->first()->id;
        },
        'client_id' => function () {
            return App\Client::inRandomOrder()->first()->id;
        },
        'date_sale' => $faker->date(),
        'qtd_product' => rand(1, 20),
        'discount' => $faker->randomFloat(0,0, 100),
        'status' => rand(1, 3)
    ];
});

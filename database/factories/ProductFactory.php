<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'=> $faker->streetName,
        'description' => $faker->text(100),
        'price' => $faker->randomFloat(0,20, 200),
        'img_src' => $faker->imageUrl($width = 200, $height = 200)
    ];
});

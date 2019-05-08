<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'product_name' => substr($faker->sentence(2), 0, -1),
        'quantity_in_stock' => $faker->randomFloat(0, 0, 9),
        'price_per_item' => $faker->randomFloat(1, 0, 9),
    ];
});

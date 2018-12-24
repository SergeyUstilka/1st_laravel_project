<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    $name =$faker->sentence(3);
    return [
        'name'=>$name,
        'price'=>$faker->randomFloat(10, 0 ,100),
        'slug'=>str_slug($name),
        'content'=>$faker->text(300),
        'cat_id'=>(\App\Models\Category::query()->inRandomOrder()->limit(1)->get()[0])->id
    ];
});

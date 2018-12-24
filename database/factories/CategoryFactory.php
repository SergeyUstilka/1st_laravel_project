<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'name'=>$faker->word,
        'description'=>$faker->text,
        'slug'=>str_slug($faker->word)
    ];
});

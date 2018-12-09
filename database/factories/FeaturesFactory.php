<?php

use Faker\Generator as Faker;

$factory->define(App\Feature::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'icon'=> $faker->image('storage/app/public/features_images',400,300, null, false)
    ];
});

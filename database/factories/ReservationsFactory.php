<?php

use Faker\Generator as Faker;

$factory->define(App\Reservation::class, function (Faker $faker) {
    $person=\App\Person::all()->random();
    $start=$faker->unique()->dateTimeBetween($startDate = "now", $endDate = "60 days")->format('Y-m-d');
    return [
        'apartment_id'=>\App\Apartment::all()->random()->id,
        'persons_id'=>$person->id,
        'name'=>$person->name,
        'email'=>$faker->email,
        'phone'=>$faker->phoneNumber,
        'id_document_picture'=> $faker->image('storage/app/public/document_photos',400,300, 'people', false),
        'check_in'=>$start,
        'check_out'=>$faker->unique()->dateTimeBetween($start, $endDate = "60 days")->format('Y-m-d'),
            ];
});

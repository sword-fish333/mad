<?php

use Faker\Generator as Faker;

$factory->define(\App\Person::class, function (Faker $faker) {
    $document_type=['Id Card','Passport'];
    return [
        'name'=>$faker->name,
        'document_type'=>$document_type[array_rand($document_type)],
        'document_nr'=>str_shuffle('12348675'),
        'document_serial_nr'=>str_shuffle('1234567890123'),
        'nationality'=>$faker->country,
        'document_picture'=> $faker->image('storage/app/public/document_photos',400,300, 'people', false),
    ];
});

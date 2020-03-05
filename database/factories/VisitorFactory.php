<?php

use Faker\Generator as Faker;

$factory->define(App\Visitor::class, function (Faker $faker) {
    return [
        'guestName' => $faker->name,
            'guestDesignation' => $faker->jobTitle,
            'guestOrg' => $faker->company,
            'restroom' => $faker->randomDigit             ,
            'bodyguardName' => $faker->name,
            'carNumber' => $faker->ean8,
            'visitingDate' => $faker->date($format = 'Y-m-d', $min='2020'),
            'messengerName' => $faker->name,
            'messengerDesignation' => $faker->jobTitle,
            'authorizerName' => $faker->name,
            'authorizerDesignation' => $faker->jobTitle,
    ];
});

<?php

use Faker\Generator as Faker;
use Lava\Model\Option;

$factory->define(Option::class, function (Faker $faker)
{
    return [
        'key' => $faker->lexify('key_????'),
        'value' => $faker->sentence(),
    ];
});

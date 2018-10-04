<?php

use Faker\Generator as Faker;
use Lava\Model\Service;

$factory->define(Service::class, function( Faker $faker )
{
	return [
		'name' => $faker->sentence(2, true),
	];
});
<?php

use Faker\Generator as Faker;
use Lava\Model\Coupon;

$factory->define(Coupon::class, function( Faker $faker )
{
	
	$start = date('Y-m-d H:i:s');
	
	$date = date('Y-m-d');
	$hour = date('H:i:s');

	$obj = new DateTime($date);
	$obj->add( new DateInterval('P10D') );

	$end = $obj->format('Y-m-d').' '.$hour;

	return [
		'name' => $faker->word,
		'type' => 'percent',
		'value' => $faker->numberBetween(5,30),
		'number' => $faker->numberBetween(5,20),
		'start_date' => $start,
		'end_date' => $end,
	];
});
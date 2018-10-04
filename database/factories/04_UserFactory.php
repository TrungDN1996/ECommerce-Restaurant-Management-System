<?php

use Faker\Generator as Faker;
use Lava\Model\User;
use Carbon\Carbon;

$factory->define(User::class, function( Faker $faker )
{
	$str = $faker->sentence(2, true);
	$explode = explode(" ", $str);
	$username = implode("", $explode);
	return [
		'name'       => $faker->name,
		'email'      => $faker->email,
		'username'   => $faker->username,
		'password'   => $faker->password,
		'address'    => $faker->address,
		'phone'      => $faker->tollFreePhoneNumber,
		'type'       => $faker->randomElement(['local', 'traveller']),
		'status'	 => $faker->randomElement(['new', 'old', 'loyal']),
		'role'       => 'user',
		'activate' 	 => $faker->randomElement([0, 1]),
		'last_login' => Carbon::now(),
	];
});

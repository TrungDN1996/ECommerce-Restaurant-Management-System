<?php

use Faker\Generator as Faker;
use Lava\Model\User;
use Lava\Model\Coupon;
use Lava\Model\Service;
use Lava\Model\Order;

$factory->define(Order::class, function( Faker $faker )
{
	$service = Service::all()->shuffle()->first();
	$coupon  = Coupon::all()->shuffle()->first();
	$user = User::where('role','user')->get()->shuffle()->first();
	return [
		'type'        => 'table', // 'online'
		'people'	  => $faker->numberBetween(5,20),
		'ship'		  => $faker->randomElement(['free', 'fast']), // null
		'note'        => $faker->sentence(),
		'status'      => $faker->randomElement(['unconfirmed', 'confirmed']),
		'total'       => $faker->numberBetween(200, 400),
		'paid'		  => 1,
		'received_at' => $faker->dateTime('Y-m-d H:i:s'),
		'service_id'  => $service->id, // null
		'coupon_id'   => $coupon->id,
		'user_id'     => $user->id,
	];
});

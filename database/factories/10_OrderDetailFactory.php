<?php

use Faker\Generator as Faker;
use Lava\Model\OrderDetail;
use Lava\Model\Product;
use Lava\Model\Order;


$factory->define(OrderDetail::class, function (Faker $faker)
{
	$product = Product::all()->shuffle()->first();
	return [
		'order_id' 	 => 1,
		'product_id' => $product->id,
		'price'		 => $product->price,
		'quantity'   => $faker->numberBetween(1, 20),
	];
});

<?php

use Faker\Generator as Faker;
use Lava\Model\Product;
use Lava\Model\Category;

$factory->define(Product::class, function( Faker $faker )
{
	$category = Category::where('type','product')->get()->shuffle()->first();
	return [
		'name' => $faker->sentence(2, true),
		'description' => $faker->paragraph(3, true),
		'type' => $faker->randomElement(['drink', 'appetizer', 'entree', 'dessert']),
		'status' => 1,
		'price' => $faker->numberBetween( 15, 100 ),
		'category_id' => $category->id,
	];
});

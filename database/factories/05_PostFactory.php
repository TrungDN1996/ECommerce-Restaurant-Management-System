<?php

use Faker\Generator as Faker;
use Lava\Model\Category;
use Lava\Model\Product;
use Lava\Model\User;
use Lava\Model\Post;

$factory->define(Post::class, function( Faker $faker )
{
	$count    = Product::all()->count();
	$user     = User::where('role', 'admin')->get()->shuffle()->first();
	$category = Category::where('type', 'post_product')->get()->shuffle()->first();
	$title = $faker->sentence();
	$slug = str_slug($title);
	$paras = $faker->paragraphs(5);
	$content = $faker->sentence();
	foreach ($paras as $key => $val) {
		$content = $content.$val;
	}
	return [
		'type'        => 'post_product',
		'slug'        => $slug,
		'title'       => $title,
		'excerpt'     => $faker->paragraph(2, true),
		'thumbnail'   => null,
		'content'     => $content,
		'published'   => 1,
		'product_id'  => factory(Product::class)->create()->id,
		'user_id'     => $user->id,
		'category_id' => $category->id,
	];
});

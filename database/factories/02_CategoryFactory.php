<?php

use Faker\Generator as Faker;
use Lava\Model\Category;

$factory->define(Category::class, function( Faker $faker )
{
	/**
     * [$post_cate description]
     *
     *
     * @var [type]
     */
    $post_cate = Category::where('type', 'post')->whereNull('parent_id')->first();

    for ($i = 1; $i <= 3; $i++) {
    	$post_cate_faker = [
			'slug' => $faker->slug,
			'name' => $faker->sentence(2,true),
			'description' => $faker->paragraph(3, true),
			'type' => 'post',
			'parent_id' => $post_cate->id,
		];
        Category::create($post_cate_faker);
    }


    $product_cate = Category::where('type', 'product')->whereNull('parent_id')->first();

    for ($i = 1; $i <= 3; $i++) {
    	$product_cate_faker = [
			'slug' => $faker->slug,
			'name' => $faker->sentence(2,true),
			'description' => $faker->paragraph(3, true),
			'type' => 'product',
			'parent_id' => $product_cate->id,
		];

        Category::create($product_cate_faker);
    }


    $post_product_cate = Category::where('type', 'post_product')->whereNull('parent_id')->first();

    for ($i = 1; $i <= 3; $i++) {
    	$post_product_cate_faker = [
			'slug' => $faker->slug,
			'name' => $faker->sentence(2,true),
			'description' => $faker->paragraph(3, true),
			'type' => 'post_product',
			'parent_id' => $post_product_cate->id,
		];
        Category::create($post_product_cate_faker);
    }



    /**
     * [$post_cates description]
     *
     *
     * @var [type]
     */
    $post_cates = Category::where('type', 'post')->whereNotNull('parent_id')->get();

    foreach ($post_cates as $post_cate) {
    	for ($i = 1; $i <= 5; $i ++) {
    		$post_cate_faker = [
				'slug' => $faker->slug,
				'name' => $faker->sentence(2,true),
				'description' => $faker->paragraph(3, true),
				'type' => 'post',
				'parent_id' => $post_cate->id,
			];
	    	Category::create($post_cate_faker);
    	}
    }

    $product_cates = Category::where('type', 'product')->whereNotNull('parent_id')->get();

    foreach ($product_cates as $product_cate) {
    	for ($i = 1; $i <= 5; $i++) {
    		$product_cate_faker = [
				'slug' => $faker->slug,
				'name' => $faker->sentence(2,true),
				'description' => $faker->paragraph(3, true),
				'type' => 'product',
				'parent_id' => $product_cate->id,
			];
	    	Category::create($product_cate_faker);
    	}
    }

    $post_product_cates = Category::where('type', 'post_product')->whereNotNull('parent_id')->get();

    foreach ($post_product_cates as $post_product_cate) {
    	for ($i = 1; $i <= 5; $i++) {
    		$post_product_cate_faker = [
				'slug' => $faker->slug,
				'name' => $faker->sentence(2,true),
				'description' => $faker->paragraph(3, true),
				'type' => 'post_product',
				'parent_id' => $post_product_cate->id,
			];
			Category::create($post_product_cate_faker);
    	}
    }

    return [
    	'slug' => $faker->slug,
		'name' => $faker->sentence(2,true),
		'description' => $faker->paragraph(3, true),
		'type' => 'post',
		'parent_id' => 7,
    ];
});

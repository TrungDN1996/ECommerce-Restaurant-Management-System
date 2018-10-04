<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Lava\Model\Category;
use Carbon\Carbon;

class CategoryTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('categories')->insert([
    		[
				'slug' => 'uncategory',
				'name' => 'uncategory',
				'description' => 'the default category of all post',
				'type' => null,
				'parent_id' => null,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
			],
			[
				'slug' => 'post-cate',
				'name' => 'Post Cate',
				'description' => 'The default category with type = post',
				'type' => 'post',
				'parent_id' => null,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
			],
			[
				'slug' => 'product-cate',
				'name' => 'Product Cate',
				'description' => 'The default category with type = product',
				'type' => 'product',
				'parent_id' => null,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
			],
			[
				'slug' => 'post-product-cate',
				'name' => 'Post_product Cate',
				'description' => 'The Default Category with type = post_product',
				'type' => 'post_product',
				'parent_id' => null,
				'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
			]
    	]);
    }
}

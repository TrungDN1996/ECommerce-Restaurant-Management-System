<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Lava\Model\Option;
use Lava\Model\Category;
use Lava\Model\Product;
use Lava\Model\User;
use Lava\Model\Post;
use Lava\Model\Comment;
use Lava\Model\Coupon;
use Lava\Model\Service;
use Lava\Model\Order;
use Lava\Model\OrderDetail;

class DBFactory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Step 1
         *
         * Generate category database
         */
        factory(Category::class)->create();

         /**
          * Step 3.2
          *
          * Generate User with role = 'user' database
          */
        factory(User::class, 50)->create();

        /**
         * Step 4.1
         *
         * Generate Post database with type = 'post_product'
         *
         * with each post data was generated
         * it will generate each product.
         * relationship : one - one
         */
        factory(Post::class, 50)->create();

        /**
         * Step 4.2
         *
         * Generate post database with type = 'post'
         */
        factory(Post::class, 60)->create([
            'type' => 'post',
            'product_id' => null,
            'category_id' => function(){
                $category = Category::where('type', 'post')->get()->shuffle()->first();
                return $category->id;
            },
        ]);

        /**
         * step 5
         *
         * Generate comment database
         */
        factory(Comment::class, 200)->create();

        /**
         * Step 6
         *
         * Generate coupon database
         */
        factory(Coupon::class, 10)->create();

        /**
         * Step 7
         *
         * Generate Service database
         */
        factory(Service::class, 4)->create();

        /**
         * Step 8.1
         *
         * Generate Order database with type = 'table'
         */
        factory(Order::class,50)->create([
            'ship' => null,
        ]);

        /**
         * Step 8.2
         *
         *
         * Generate Order database with type = 'online'
         */
        factory(Order::class, 50)->create([
            'type'       => 'online',
            'people'     => 1,
            'service_id' => null,
        ]);

        /**
         * Step 9
         *
         * Generate orderDetail Factory
         * each order with get 5 orderDetails
         */
        $orders = Order::all();
        foreach ($orders as $order) {
            factory(OrderDetail::class,5)->create([
                'order_id' => $order->id,
            ]);
        }
    }
}

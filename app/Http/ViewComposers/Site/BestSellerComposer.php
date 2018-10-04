<?php

namespace Lava\Http\ViewComposers\Site;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class BestSellerComposer
{
    public function compose(View $view)
    {
        $bestSellers = DB::select("
            SELECT posts.slug, posts.thumbnail, products.name, COUNT(order_details.product_id) AS count
            FROM products
            JOIN posts ON posts.product_id = products.id
            JOIN order_details ON order_details.product_id = products.id
            GROUP BY order_details.product_id
            ORDER BY count DESC
            LIMIT 5"
        );

        $view->with('bestSellers', $bestSellers);
    }
}

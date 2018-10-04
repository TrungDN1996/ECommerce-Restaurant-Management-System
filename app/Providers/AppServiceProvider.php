<?php

namespace Lava\Providers;

use Illuminate\Support\ServiceProvider;
use Lava\Observers\CategoryObserver;
use Lava\Observers\CouponObserver;
use Lava\Observers\FileObserver;
use Lava\Observers\OrderObserver;
use Lava\Observers\PostObserver;
use Lava\Observers\ProductObserver;
use Lava\Observers\ServiceObserver;
use Lava\Observers\UserObserver;
use Lava\Model\Category;
use Lava\Model\Coupon;
use Lava\Model\File;
use Lava\Model\Order;
use Lava\Model\Post;
use Lava\Model\Product;
use Lava\Model\Service;
use Lava\Model\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Category::observe(CategoryObserver::class);
        Coupon::observe(CouponObserver::class);
        File::observe(FileObserver::class);
        Order::observe(OrderObserver::class);
        Post::observe(PostObserver::class);
        Product::observe(ProductObserver::class);
        Service::observe(ServiceObserver::class);
        User::observe(UserObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

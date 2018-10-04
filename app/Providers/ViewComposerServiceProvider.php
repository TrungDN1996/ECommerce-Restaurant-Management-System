<?php

namespace Lava\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use Lava\Http\ViewComposers\Admin\Media\IndexComposer as AdminMediaIndexComposer;
use Lava\Http\ViewComposers\Admin\User\EditComposer as AdminUserEditComposer;
use Lava\Http\ViewComposers\Admin\User\IndexComposer as AdminUserIndexComposer;
use Lava\Http\ViewComposers\Admin\Post\CreateComposer as AdminPostCreateComposer;

use Lava\Http\ViewComposers\User\ServiceComposer as UserService;

use Lava\Http\ViewComposers\Site\CategoryComposer as SiteCategory;
use Lava\Http\ViewComposers\Site\FooterCategoryComposer as SiteFooterCategory;
use Lava\Http\ViewComposers\Site\BestSellerComposer as SiteBestSeller;
use Lava\Http\ViewComposers\Site\RecentNewsComposer as SiteRecent;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


        /**
         * Admin view Compsoer
         */
         View::composer('admin.media.index', AdminMediaIndexComposer::class);

         View::composer('admin.user.edit', AdminUserEditComposer::class);

         View::composer('admin.user.index', AdminUserIndexComposer::class);

         View::composer('admin.post.create', AdminPostCreateComposer::class);

         /**
         * User View Composer
         */
         View::composer('user.cart.bookTable', UserService::class);

         /**
          * Site View Composer
          */
         View::composer('site.category.product_post', SiteCategory::class);

         View::composer('site.sidebar.post', SiteCategory::class);

         View::composer('site.sidebar.product', SiteCategory::class);

         View::composer('site.elements.footer', SiteFooterCategory::class);

         View::composer('site.elements.slide', SiteBestSeller::class);

         View::composer('site.elements.recent_news', SiteRecent::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

namespace Lava\Http\ViewComposers\Admin\Post;

use Illuminate\View\View;
use Lava\Model\Post;
use Lava\Model\Category;
use Lava\Model\Product;

class CreateComposer
{
    /**
     *
     * @var array
     */
    protected $categories;
    protected $categories_post;
    protected $categories_product;
    protected $categories_post_product;
    protected $products;

    /**
     *
     */
    public function __construct()
    {
        $this->categories = get_cate();
        $this->categories_post = get_cate_post();
        $this->categories_product = get_cate_product();
        $this->categories_post_product = get_cate_post_product();
        $array_id = Post::where('type', 'post_product')->pluck('id')->all();
        $this->products = Product::whereNotIn('id', $array_id)->get();
    }

    /**
     *
     */
    public function compose(View $view)
    {
        $view->with('categories', $this->categories)
             ->with('categories_post', $this->categories_post)
             ->with('categories_product', $this->categories_product)
             ->with('categories_post_product', $this->categories_post_product)
             ->with('products', $this->products);
    }
}

<?php

namespace Lava\Http\ViewComposers\Site;

use Illuminate\View\View;
use Lava\Model\Category;

class FooterCategoryComposer
{
    /**
     * The user repository implementation.
     *
     * @var Category
     */
    protected $productCates;
    protected $postCates;

    /**
     * Create a new category composer.
     *
     * @param  Category  $categories
     * @return void
     */
    public function __construct()
    {
        $this->productCates = Category::where('type', 'post_product')->get();
        $this->postCates = Category::where('type', 'post')->get();
    }


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    { 
        $view->with('productCates', $this->productCates->random(5)->all())
             ->with('postCates', $this->postCates->random(5)->all());
    }
}
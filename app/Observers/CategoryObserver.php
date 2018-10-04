<?php

namespace Lava\Observers;

use Lava\Model\Category;
use Lava\Model\Post;
use Lava\Model\Product;

class CategoryObserver
{
    /**
     * Handle the category "deleting" event.
     *
     * @param  \Lava\Model\Category  $category
     * @return void
     */
    public function deleting(Category $category)
    {
        foreach($category->posts as $post) {
            $post = Post::find($post->id);
            $post->category_id = null;
            $post->save();
        }
        foreach($category->products as $product) {
            $product = Product::find($product->id);
            $product->category_id = null;
            $product->save();
        }
    }
}

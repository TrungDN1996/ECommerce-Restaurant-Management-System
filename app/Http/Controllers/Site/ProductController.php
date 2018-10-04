<?php

namespace Lava\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Lava\Http\Requests\Site\SearchProductPost;
use Lava\Http\Controllers\Controller;
use Lava\Model\Post;
use Lava\Model\OrderDetail;
use Lava\Model\Category;

class ProductController extends Controller
{
    /**
     * [List all product posts]
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('type', 'post_product')
        ->orderBy('created_at', 'DESC')
        ->paginate(6);

        return view('site.page.menu')->with('posts', $posts);
    }

    /**
     * [list product posts of each category]
     * @param  [int] $category
     * @return Illuminate\Http\Response
     */
    public function categoryShow($slug)
    {
        $category = Category::where('slug', $slug)->first();

        $posts = get_post_in_cate($category->id)->paginate(6);

        return view('site.page.menu')->with('posts', $posts)
                                     ->with('category', $category);
    }

    /**
     * [Show detail of product post]
     *
     * @param  Post   $post
     * @return Illuminate\Http\Response
     */
    public function show($slug)
    {
    	$post = Post::Where('type', 'post_product')->where('slug', $slug)->first();

        return view('site.post.postProduct')->with('post', $post);
    }

    /**
     * [Search product post by product name and product post title]
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->input('search');

        $posts = Post::join('products', 'products.id', '=', 'posts.product_id')
        ->select('posts.*', 'products.name', 'products.price')
        ->where('posts.title', 'like', '%'.$search.'%')
        ->orWhere('products.name', 'like', '%'.$search.'%')
        ->orWhere('products.price', 'like', '%'.$search.'%')
        ->paginate(6);

        return view('site.page.menu')->with('posts', $posts);
    }

    /**
     * [Filter by price]
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $min = $request->input('min');
        $max = $request->input('max');

        if($min AND $max)
        {
            $price = DB::table('products')
            ->select('id')
            ->where('price', '>=', $min)
            ->where('price', '<=', $max)
            ->pluck('id');
        }
        elseif($min OR $max)
        {
            if($min)
            {
                $price = DB::table('products')
                ->select('id')
                ->where('price', '>=', $min)
                ->pluck('id');
            }
            elseif($max)
            {
                $price = DB::table('products')
                ->select('id')
                ->where('price', '<=', $max)
                ->pluck('id');
            }
        }

        $posts = Post::whereIn('product_id', $price)
        ->orderBy('created_at', 'DESC')
        ->paginate(6);

        return view('site.page.menu')->with('posts', $posts);
    }

    /**
     * [Routes connect to Site\ProductPostControllers]
     * @return
     */
    public static function routes()
    {
        return Route::group([
            'prefix' => 'menu',
            'namespace' => 'Site',
        ], function(){
            Route::name('menu')->group(function(){
                Route::get( '/', 'ProductController@index');
                Route::get('category/{category}', 'ProductController@categoryShow')->name('.category.show');
                Route::get('post/{post}', 'ProductController@show')->name('.post.show');
                Route::get('search', 'ProductController@search')->name('.search');
                Route::get('filter', 'ProductController@filter')->name('.filter');
            });
        });
    }
}

<?php

namespace Lava\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Lava\Http\Controllers\Controller;
use Lava\Model\Post;
use Lava\Model\Category;

class PostController extends Controller
{
    /**
     * [List all product posts]
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('type', 'post')
                ->orderBy('created_at', 'DESC')
                ->paginate(4);

    	return view('site.page.blog')->with('posts', $posts);
    }

    /**
     * [list product posts of each category]
     *
     * @param  [int] $category
     * @return Illuminate\Http\Response
     */
    public function categoryShow($category)
    {

        $category = Category::where('slug', $category)->first();
        $posts = get_post_in_cate($category->id)->paginate(4);

    	return view('site.page.blog')->with('category', $category)
                                     ->with('posts', $posts);
    }

    /**
     * [Show a news post]
     *
     * @param  Post   $post
     * @return Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
    	return view('site.post.post')->with('post', $post);
    }

    /**
     * [Routes connect to Site\NewPostControllers]
     *
     * @return
     */
    public static function routes()
    {
        return Route::group([
            'prefix' => 'blog',
            'namespace' => 'Site',
        ], function(){
            Route::name('blog')->group(function(){
                Route::get( '/', 'PostController@index');
                Route::get('/category/{category}', 'PostController@categoryShow')->name('.category.show');
                Route::get('/post/{slug}', 'PostController@show')->name('.post.show');
            });
        });
    }
}

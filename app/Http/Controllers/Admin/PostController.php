<?php

namespace Lava\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Lava\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Lava\Model\File;
use Lava\Model\Post;
use Lava\Model\Product;
use Lava\Model\Category;
use Lava\Model\User;

class PostController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    	$this->middleware('admin');
    }

/**
 *  ***************************************************
 */
    /**
     * [index description]
     * @return [type] [description]
     */
     public function index()
     {
     	$posts = Post::orderBy('created_at', 'desc')->paginate(10);
     	//dd($posts);
     	$product = Product::select('name', 'id')->get();
     	//dd($product);
     	$category = Category::select('name', 'id', 'parent_id')->get();

     	$user = User::select('name', 'id')->where('role', 'admin')->get();
     	//dd($user);
     	return view('admin.post.index', compact('product', 'category', 'user'))->with('posts', $posts);
     }

     public function getType(Request $request, $type)
     {
         $data = $request->type;
         switch ($data) {
             case 'all':
                 $types = Post::all();
                 break;
             case 'post':
                 $types = Post::where('type', $type)->get();
                 break;
             case 'post_product':
                 $types = Post::where('type', $type)->get();
                 break;
             case 'product':
                 $types = Post::where('type', $type)->get();
                 break;
             default:
                 break;
         }
     	//$types = Post::where('type', $type)->get();
     	//dd($types);

     	return view('admin.post.list')->with('types', $types);
     }

     public function getUserID($id)
     {
         $user_id = Post::where('user_id', $id)->get();
         //dd($product_id);
         return view('admin.post.user_name')->with('user_id', $user_id);
     }

     public function getCategoryID($id)
     {
         $category_id = Post::where('category_id', $id)->get();
         if(count($category_id) != 0){
             return view('admin.post.category_name')->with('category_id', $category_id);
         }else
         {
             echo "<script type='text/javascript'>
             alert('No record found with this category');
             window.location = '";
             echo route('admin.post');
             echo"'
             </script>";
         }

     }

     public function search(Request $request)
     {
         $data = $request->all();
         //dd($data);
         $searchs = Post::where('title', 'like', '%'.$data['search'].'%')
                     ->orWhere('product_id', 'like', '%'.$data['search'].'%')
                     ->get();
         //dd($searchs);
         if (count($searchs) != 0){
             return view('admin.post.search')->with('searchs', $searchs);
         }else
         {
             echo ('No result found with this search');
         }
     }

     /**
      * Delete user
      */
     public function destroy($id)
     {
         Post::find($id)->delete();
         return redirect()->route('admin.post')
                          ->withMessage('Deleted Successfully');
     }


/**
 *  ***************************************************
 */
    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {
        $files = File::all()->sortByDesc('created_at');
        $years = File::selectRaw('year(created_at) year')
                    ->groupBy('year')
                    ->orderByRaw('min(created_at) desc')
                    ->get()
                    ->toArray();
    	return view('admin.post.create')->with('files', $files)
                                        ->with('years', $years);
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
    	$data = $request->all();
        return $data;
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
    	$post = Post::find($id)->first();
    	return view('admin.post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        return $data;
    }

    /**
     * convert title to slug
     */
    public function slug(Request $request)
    {
        $data = $request->all();
        return str_slug($data['title'], '-');
    }

    /**
     * upload Image
     * @return [type] [description]
     */
    public function uploadImageToContent(Request $request)
    {
        if ($request->hasFile('file')) {

            $hashName = $request->file->hashName();
            $clientName = $request->file->getClientOriginalName();
            $path = 'storage/uploaded/image/'.$hashName;
            $size = formatSizeUnits($request->file->getSize());

            File::create([
                'name' => $hashName,
                'url' => $path,
                'size' => $size,
                'type' => 'image',
                'client_name' => $clientName,
                'user_id' => Auth::id(),
            ]);

            $store = $request->file->store('public/uploaded/image');
            $location = asset($path);
            return response()->json(['location' => $location], 200);
        } else {
            $location = asset('media/500.png');
            return response()->json(['location' => $location], 200);
        }
    }

    /**
     * jquery ajax: return list of categories
     * in html '<option></option>'
     *
     * @param  Request $request [description]
     * @return string
     */
    public function getCateList(Request $request)
    {
        $data = $request->all();

        switch ($data['postType']) {
            case 'post':
                $catelist = get_cate_post();
                $html = option_list_cate($cateList);
            break;
            case 'post_product':
                $cateList = get_cate_post_product();
                $html = option_list_cate($cateList);
            break;
        }
        $html = '<option value="null">---Select category---</option>'.$html;
        return $html;
    }


    /**
     * create routes
     *
     * @return [type] [description]
     */
    public static function routes()
    {
    	return Route::group([
    		'prefix' => 'admin/post',
    		'namespace' => 'Admin',
    	], function(){
    		Route::name('admin.post')->group(function(){
                Route::get('/', 'PostController@index');
                Route::get('/list/search', 'PostController@search')->name('.search');
                Route::get('/{type}/type', 'PostController@getType')->name('.type');
                Route::get('/{id}/user', 'PostController@getUserID')->name('.userID');
                Route::get('/{id}/category', 'PostController@getCategoryID')->name('.categoryID');
                Route::delete('/{id}/delete', 'PostController@destroy')->name('.destroy');

                /**
                 *  ***************************************************
                 */

    			Route::get('/create', 'PostController@create')->name('.create');
    			Route::post('/store', 'PostController@store')->name('.store');
    			Route::get('/{id}/edit', 'PostController@edit')->name('.edit');
                Route::post('/create/slug', 'PostController@slug')->name('.slug');
                Route::post('/upload/image/to/content', 'PostController@uploadImageToContent')->name('.create.upload.image');
                Route::post('/create/getCateList', 'PostController@getCateList')->name('.create.getCateList');
    		});
    	});
    }
}

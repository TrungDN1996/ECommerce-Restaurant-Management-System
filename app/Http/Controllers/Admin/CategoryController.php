<?php

namespace Lava\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Lava\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Lava\Http\Providers\AppServiceProvider;
use Lava\Http\Requests\CategoryRequest;
use Lava\Model\Category;
use Lava\Model\Product;
use Lava\Model\Post;
use Lava\Model\OrderDetail;
use Lava\Model\Comment;
use Validator;
use DB;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::paginate(10);
        return view('admin.category.index')->with('category', $category);
    }

     public function create()
    {
        $categories = Category::select('id','name','parent_id')->get()->toArray();
        //dd($categories);
        return view('admin.category.create', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->slug =  str_slug($request->name, "-");
        $category->description = $request->description;
        $category->type = $request->type; //
        $category->parent_id = $request->parent;
        $category->save();

        return redirect()
            ->route('admin.category', $category->id )
            ->withSuccess('Add category success');
    }

    public function edit($id)
    {
        $types = Category::select('id','type')->where('id', $id)->first();
        //dd($types);
        $categories = Category::select('id','name','parent_id')->get()->toArray();
        $category = Category::find($id);
        return view('admin.category.edit', compact('types','categories', 'id'))->with('category', $category);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug =  str_slug($request->name, "-");
        $category->description = $request->description;
        $category->type = $request->type;
        $category->parent_id = $request->parent;
        $category->save();

        return redirect()
            ->route('admin.category', $category->id)
            ->withSuccess('Update category success');

    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()
            ->route('admin.category')
            ->withSuccess('Delete category success');

    }

    public function getType(Request $request, $type)
    {
        $data = $request->type;
        //dd($data);
        switch ($data) {
            case 'all':
                $getType = Category::all();
                break;
            case 'post':
                $getType = Category::where('type', $type)->get()->toArray();
                break;
            case 'post_product':
                $getType = Category::where('type', $type)->get()->toArray();
                break;
            case 'product':
                $getType = Category::where('type', $type)->get()->toArray();
                break;
            default:
                break;
        }

        return view('admin.category.list')->with('getType', $getType);
    }

    public function getCategoryParentType($id)
    {
        $category = Category::where('id', $id)->first();

        return "<option value='".$category->type."'>".$category->type."</option>";
    }

    public static function routes()
    {
        return Route::group([
                    'prefix' => 'admin/category',
                    'namespace' => 'Admin',
                ], function(){
                Route::name('admin.category')->group(function(){
                    Route::get('/', 'CategoryController@index');
                    Route::get('/create', 'CategoryController@create')->name('.create');
                    Route::post('/', 'CategoryController@store')->name('.store');
                    Route::get('/edit/{id}', 'CategoryController@edit')->name('.edit');
                    Route::put('/edit/{id}', 'CategoryController@update')->name('.update');
                    Route::delete('/{id}', 'CategoryController@destroy')->name('.destroy');
                    Route::get('/{type}', 'CategoryController@getType')->name('.type');
                    Route::get('/categoryparent/type/{id}', 'CategoryController@getCategoryParentType')->name('.categoryParentType');

            });
        });
    }

}

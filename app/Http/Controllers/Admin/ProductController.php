<?php

namespace Lava\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Lava\Http\Requests\ProductRequest;
use Lava\Http\Controllers\Controller;
use Lava\Model\Category;
use Lava\Model\Product;
use Validator;
use DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(15);
        //dd($products);
    	$cate = Category::select('id', 'name', 'parent_id', 'type')->where('type', 'product')->get();
    	//dd($cate);
    	return view('admin.product.index', compact('cate'))->with('products', $products);
    }

    public function create()
    {
        $cate = Category::select('id', 'name', 'parent_id', 'type')->where('type', 'product')->get();
        $product = Product::pluck('type', 'id');

    	return view('admin.product.create', compact('cate', 'product'));
    }

    public function store( ProductRequest $request)
    {
        $data = $request->all();
        $product = Product::create($data);
        return redirect()
            ->route('admin.product', $product->id)
            ->withSuccess('Add product success');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $cate = Category::select('id', 'name', 'parent_id', 'type')->where('type', 'product')->get();
        $types = Product::select('id', 'type')->where('id', $id)->first();
        return view('admin.product.edit', compact('cate', 'types', 'id'))->with('product', $product);
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $product = Product::find($id);
        $product->update($data);
        return redirect()
            ->route('admin.product', $product->id)
            ->withSuccess('Update product success');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()
            ->route('admin.product')
            ->withSuccess('Delete product success');

    }

    public function search(Request $request)
    {
        $data = $request->all();
        //dd($data);
        $searchs = Product::where('name', 'like', '%'.$data['search'].'%')
            ->orWhere('description', 'like', '%'.$data['search'].'%')
            ->orWhere('price', 'like', '%'.$data['search'].'%')
            ->orWhere('category_id', 'like', '%'.$data['search'].'%')
            ->get();
        //dd($searchs);
        if (count($searchs) != 0){
            return view('admin.product.search')->with('searchs', $searchs);
        }else{

            echo ('No result found with this search');
        }
    }

    public function getType(Request $request, $type)
    {
        $data = $request->type;
        //dd($data);
        switch ($data) {
            case 'all':
                $types = Product::all();
                break;
            case 'drink':
                $types = Product::where('type', $type)->get();
                break;
            case 'appetizer':
                $types = Product::where('type', $type)->get();
                break;
            case 'entree':
                $types = Product::where('type', $type)->get();
                break;
            case 'dessert':
                $types = Product::where('type', $type)->get();
                break;
            default:
                break;
        }

        return view('admin.product.list')->with('types', $types);

    }


    public function getName($name){
        $category = Category::with('products')->where('name', $name)->first();
        //dd($category);
        return view('admin.product.index')
        ->with('category', $category)
        ->with('products', $category->products);
    }

    public function getCategoryParentType(Request $request , $id)
    {
        $pros = Product::where('category_id', $id)->get();
        foreach($pros as $pro){
            echo "<option value='".$pro->type."'>".$pro->type."</option>";
        }
    }

    public function listpage(Request $request, $page)
    {
        $data = $request->page;
        //dd($data);
        switch ($data) {
            case 'all':
                $pages = Product::where('id', '>=', 1)->get();
                break;
            case '5':
                $pages = Product::orderBy('created_at', 'desc')->paginate($data);
                break;
            case '6':
                $pages = Product::orderBy('created_at', 'desc')->paginate($data);
                break;
            case '7':
                $pages = Product::orderBy('created_at', 'desc')->paginate($data);
                break;
            case '8':
                $pages = Product::orderBy('created_at', 'desc')->paginate($data);
            default:
                $pages = Product::orderBy('created_at', 'desc')->paginate($page);
                break;
        }

        return view('admin.product.page')->with('pages', $pages);

    }

    public function filter(Request $request)
    {
        $data  = $request->all();
        //dd($data);
        $cate  = $request->category;
        $produ = $request->product;
        //dd($prod);
        //dd($cate);
        switch ($cate) {
            case 'all':
                $prod = Product::all();
                //dd($prod);
                break;
            default:
                $prod = Product::where('category_id', $cate);
                break;
            }

        switch ($produ) {
            case 'all':
                if($cate == 'all'){
                    $prods = Product::all();
                }else{
                    $prods = Product::where('category_id', $cate)->get();
                //dd($prods);
                }
                break;
            default:
                $prods = $prod->where('type', $produ)->get();
                //dd($prods);
                break;
        }

        if (empty($prods))
            return "No Record Found";
        return view('admin.product.filter')->with('prods', $prods);
    }

    public function showDelete(){
        $showDeletes = Product::orderBy('deleted_at', 'desc')->onlyTrashed()->paginate(15);
        //dd($showDelete);
        return view('admin.product.showDelete')->with('showDeletes', $showDeletes);
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->where('id', $id)->first();
        //dd($product);
        $product->restore();
        return redirect()
            ->route('admin.product', $product->id)
            ->withSuccess('Restored product successfully');
    }

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->where('id', $id)->first();
        $product->forceDelete();
        return redirect()
            ->route('admin.product')
            ->withSuccess('Product has been completed deleted');
    }


    public static function routes()
    {
        return Route::group([
            'prefix' => 'admin/product',
            'namespace' => 'Admin',
        ], function(){
            Route::name('admin.product')->group(function(){
                Route::get('/', 'ProductController@index');
                Route::get('/create', 'ProductController@create')->name('.create');
                Route::post('/', 'ProductController@store')->name('.store');
                Route::get('/edit/{id}', 'ProductController@edit')->name('.edit');
                Route::put('/edit/{id}', 'ProductController@update')->name('.update');
                Route::delete('/{id}', 'ProductController@destroy')->name('.destroy');
                Route::get('/type/{type}', 'ProductController@getType')->name('.type');
                Route::get('/search', 'ProductController@search')->name('.search');
                Route::get('/selectBox/select/{id}', 'ProductController@getCategoryParentType')->name('.getCategoryParentType');
                Route::get('/listpage/{page}', 'ProductController@listpage')->name('.listpage');
                Route::get('/filter/filterByAjax', 'ProductController@filter')->name('.filter');
                Route::get('/showdelete', 'ProductController@showDelete')->name('.showDelete');
                Route::get('/showdelete/restore/{id}', 'ProductController@restore')->name('.restore');
                Route::delete('/showdelete/forcedelete/{id}', 'ProductController@forceDelete')->name('.forceDelete');

             });
        });
    }

}

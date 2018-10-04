<?php

namespace Lava\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Lava\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Lava\Model\Post;
use Lava\Model\Order;
use Lava\Model\OrderDetail;
use Lava\Http\Requests\Cart\OrderFormRequest;
use Session;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('user');
    }

	/**
	 * [Display all items in cart]
	 * @return Illuminate\Http\Response
	 */
    public function index()
    {
    	$cartItems = Cart::instance('shopping')->content();

    	return view('user.cart.index', ['cartItems' => $cartItems]);
    }

    /**
     * [Store items into shopping cart]
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	Cart::instance('shopping')->add(
    		[
    			'id' => $request->input('id'),
    			'qty' => 1,
    			'name' => $request->input('name'),
    			'price' => $request->input('price')
    		]
    	)->associate('Lava\Model\Post');

    	return redirect()->route('menu');
    }

    /**
     * [Update quality of item in shopping cart]
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    	Cart::instance('shopping')->update(
    		$request->input('rowId'),
    		['qty' => $request->input('qty')]
    	);

    	Session::flash('success', 'Update item quantity successfully');

    	return redirect()->route('user.cart.index');
    }

    /**
     * [Remove each item in shopping cart]
     * @param int $item
     * @return Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    	Cart::instance('shopping')->remove($request->input('rowId'));

        Session::flash('success', 'Remove item successfully');

    	return redirect()->route('user.cart.index');
    }

    /**
     * [Save items to favorite cart]
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function saveFavorite(Request $request)
    {
    	$item = Cart::instance('shopping')
            ->get($request->input('rowId'));

        Cart::instance('favorite')->add(
            [
                'id' => $item->id,
                'name' => $item->name,
                'qty' => 1,
                'price' => $item->price
            ]
        )->associate('Lava\Model\Post');

        Session::flash('success', 'Save to favorite successfully');

        return redirect()->route('user.cart.index');
    }

    /**
     * [Display favorit cart]
     * @return [type] [description]
     */
    public function indexFavorite()
    {
        $cartItems = Cart::instance('favorite')->content();

        return view('user.cart.saveItem', compact('cartItems'));
    }

    /**
     * [Destroy item in favorite cart]
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function destroyFavorite(Request $request)
    {
        Cart::instance('favorite')->remove($request->input('rowId'));

        Session::flash('success', 'Remove item successfully');

        return redirect()->route('user.cart.indexFavorite');
    }

    /**
     * [Add item to shopping cart]
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function addCart(Request $request)
    {
        $item = Cart::instance('favorite')->get($request->input('rowId'));

        Cart::instance('shopping')->add(
            [
                'id'=> $item->id,
                'name' => $item->name,
                'qty' => 1,
                'price' => $item->price
            ]
        )->associate('Lava\Model\Post');

        Session::flash('success', 'Add to shopping cart successfully');

        return redirect()->route('user.cart.indexFavorite');
    }

    /**
     * [Access delivery order form]
     * @return Illuminate\Http\Response
     */
    public function getOrder()
    {
        $cartItems = Cart::instance('shopping')->content();

        return view('user.cart.orderForm', compact('cartItems'));
    }

    /**
     * [Sending Order]
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function order(OrderFormRequest $request)
    {
        $dateTime = [$request->input('date'), $request->input('time')];

        Order::create(
            [
                'user_id' => $request->user_id,
                'type' => $request->type,
                'ship' => $request->ship,
                'received_at' => implode(' ', $dateTime),
                'note' => $request->note,
                'status' => 'unconfirmed',
                'total' => Cart::instance('shopping')->subtotal()
            ]
        );

        $orderId = Order::select('id')->orderBy('id', 'DESC')
            ->first();

        foreach(Cart::instance('shopping')->content() as $cartItem)
        {
            OrderDetail::create(
                [
                    'order_id' => $orderId->id,
                    'product_id' => $cartItem->model->product_id,
                    'quantity' => $cartItem->qty,
                    'price' => $cartItem->price
                ]
            );
        }

        Cart::instance('shopping')->destroy();

        Session::flash('Success', 'You ordered successfully, Thank you!!');

        return redirect()->route('user.cart.index')
                         ->withSuccess('Ordered Successfully');
    }

    /**
     * [Routes connect to User\CartControllers]
     * @return
     */
    public static function routes()
    {
        return Route::group([
            'prefix' => 'user/cart',
            'namespace' => 'User',
        ], function(){
            Route::name('user.cart')->group(function(){
                Route::get('shopping', 'CartController@index')->name('.index');
                Route::post('shopping/store', 'CartController@store')->name('.store');
                Route::delete('shopping/destroy','CartController@destroy')->name('.destroy');
                Route::put('shopping/update', 'CartController@update')->name('.update');
                Route::post('shopping/save', 'CartController@saveFavorite')->name('.saveFavorite');
                Route::get('favorite','CartController@indexFavorite')->name('.indexFavorite');
                Route::delete('favorite/destroy', 'CartController@destroyFavorite')->name('.destroyFavorite');
                Route::post('favorite/add', 'CartController@addCart')->name('.addFavorite');
                Route::get('checkout', 'CartController@getOrder')->name('.getOrder');
                Route::post('order', 'CartController@order')->name('.order');
            });
        });
    }
}

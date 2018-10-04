<?php

namespace Lava\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Lava\Http\Controllers\Controller;
use Lava\Model\Order;
use Lava\Model\OrderDetail;
use Illuminate\Support\Facades\DB;
use Session;
use Mail;

class OrderController extends Controller
{
    /**
     * [Show orders list]
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('status', 'unconfirmed')
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

    	return view('admin.order.index', compact('orders'));
    }

    /**
     * [Show confirmed orders]
     * @return Illuminate\Http\Response
     */
    public function showConfirmedorders()
    {
        $orders = Order::where('status', 'confirmed')
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

        return view('admin.order.confirmedOrders', compact('orders'));
    }
    /**
     * [Search order by user name]
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function searchUnconfirmed(Request $request)
    {
		$users = DB::table('users')->select('id')
		->where('name', 'like', '%'.$request->input('search').'%')
		->get();
		$searchs = Order::whereIn('user_id', $users->pluck('id'))
            ->where('status', 'unconfirmed')
			->orderBy('id', 'DESC')
			->paginate(15);

        return view('admin.order.searchUnconfirmed', compact('searchs'));
    }

    /**
     * [Search order by user name]
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function searchConfirmed(Request $request)
    {
        $users = DB::table('users')->select('id')
        ->where('name', 'like', '%'.$request->input('search').'%')
        ->get();
        $searchs = Order::whereIn('user_id', $users->pluck('id'))
            ->where('status', 'confirmed')
            ->orderBy('id', 'DESC')
            ->paginate(15);

        return view('admin.order.searchConfirmed', compact('searchs'));
    }

    public function filterUnconfirmed(Request $request)
    {
        $unconfirmed = Order::where('type', $request->type)
            ->where('status', 'unconfirmed')
            ->paginate(15);

        return view('admin.order.filterUnconfirmed', compact('unconfirmed'));
    }

    public function filterConfirmed(Request $request)
    {
        $confirmed = Order::where('type', $request->type)
            ->where('status', 'confirmed')
            ->paginate(15);

        return view('admin.order.filterConfirmed', compact('confirmed'));
    }

    public function sortUnconfirmed(Request $request)
    {
        switch ($request->sort) {
            case 0:
                $unconfirmed = Order::join('users', 'users.id', '=', 'orders.user_id')
                    ->where('orders.status', 'unconfirmed')
                    ->select('users.name', 'orders.*')
                    ->orderBy('users.name', 'ASC')
                    ->paginate(15);
                break;

            case 1:
                $unconfirmed = Order::where('status', 'unconfirmed')
                    ->orderBy('created_at', 'ASC')
                    ->paginate(15);
                break;

             case 2:
                $unconfirmed = Order::where('status', 'unconfirmed')
                    ->orderBy('created_at', 'DESC')
                    ->paginate(15);
                break;
        }

        return view('admin.order.sortUnconfirmed', compact('unconfirmed'));
    }

    public function sortConfirmed(Request $request)
    {
        switch ($request->sort) {
            case 0:
                $confirmed = Order::join('users', 'users.id', '=', 'orders.user_id')
                    ->where('orders.status', 'confirmed')
                    ->select('users.name', 'orders.*')
                    ->orderBy('users.name', 'ASC')
                    ->paginate(15);
                break;

            case 1:
                $confirmed = Order::where('status', 'confirmed')
                    ->orderBy('created_at', 'ASC')
                    ->paginate(15);
                break;

             case 2:
                $confirmed = Order::where('status', 'confirmed')
                    ->orderBy('created_at', 'DESC')
                    ->paginate(15);
                break;
        }

        return view('admin.order.sortConfirmed', compact('confirmed'));
    }
    /**
     * [Show more information about order]
     * @param  int $order
     * @return Illuminate\Http\Response
     */
    public function show($order)
    {
    	$orderInfo = Order::select('type', 'user_id', 'service_id', 'coupon_id', 'created_at')
    		->where('id', $order)
    		->first();

    	$orderDetails = OrderDetail::select('product_id', 'quantity', 'price')
    		->where('order_id', $order)
    		->paginate(15);

    	return view('admin.order.orderInfo', compact('orderInfo', 'orderDetails'));
    }

    /**
     * [Destroy order]
     * @param  Request $request, Order  $order
     * @return Illuminate\Http\Response
     */
    public function destroy(Request $request, Order $order)
    {
        switch ($request->destroy) {
            case 0:
                $order->delete();

                Session::flash('Success', 'Delete order successfully!');

                return redirect()->route('admin.order.index');
                break;

            case 1:
                $order->delete();

                Session::flash('Success', 'Delete order successfully!');

                return redirect()->route('admin.order.showConfirmedorders');
                break;
        }
    }

    /**
     * [Confirm order]
     * @param  Order  $order
     * @return Illuminate\Http\Response
     */
    public function confirm(Order $order)
    {
        $order->update(['status' => 'confirmed']);

        $userEmail = $order->user->email;

        Mail::send('admin.order.mail', [], function($message) use ($userEmail){
            $message->from('LavaProject@gmail.com');
            $message->to($userEmail);
            $message->subject('Lava Restaurant');
        });

        Session::flash('Success', 'Confirm order successfully!');

        return redirect()->route('admin.order.index');
    }

    public function getAnalyse()
    {
        return view('admin.order.analyse');
    }
    public function analyse(Request $request)
    {
        $year = $request->year;
        $month = $request->month;
        $orderType = $request->orderType;

        if($request->subject == 'user')
        {
             $analyseUser = DB::select("SELECT u.name, COUNT(o.user_id) AS time, SUM(o.total) AS total, o.user_id
                FROM orders o
                INNER JOIN users u ON o.user_id = u.id
                WHERE o.status = ? AND o.type = ? AND YEAR(o.created_at) = ? AND MONTH(o.created_at) = ?
                GROUP BY o.user_id
                ORDER BY total DESC
                LIMIT 10", ['confirmed', $orderType, $year, $month]);

            return view('admin.order.analyse', compact('analyseUser', 'orderType'));
        }
        elseif ($request->subject == 'product')
        {
            $analyseProduct = DB::select("SELECT p.name, COUNT(d.product_id) AS time
                FROM order_details d
                INNER JOIN products p ON p.id = d.product_id
                INNER JOIN orders o ON o.id = d.order_id
                WHERE o.status = ? AND o.type = ? AND YEAR(o.created_at) = ? AND MONTH(o.created_at) = ?
                GROUP BY d.product_id
                ORDER BY time DESC
                LIMIT 10", ['confirmed', $orderType, $year, $month]);
            return view('admin.order.analyse', compact('analyseProduct', 'orderType'));
        }
    }
    /**
     * [Routes connect to Admin\OrderControllers]
     * @return
     */
    public static function routes()
    {
        return Route::group([
            'prefix' => 'admin/order',
            'namespace' => 'Admin',
        ], function(){
            Route::name('admin.order')->group(function(){
                Route::get('/', 'OrderController@index')->name('.index');
                Route::get('confirmation', 'OrderController@showConfirmedorders')->name('.showConfirmedorders');
                Route::get('unconfirmed/search','OrderController@searchUnconfirmed')->name('.searchUnconfirmed');
                Route::get('confirmed/search','OrderController@searchConfirmed')->name('.searchConfirmed');
                Route::get('unconfirmed/filter', 'OrderController@filterUnconfirmed')->name('.filterUnconfirmed');
                Route::get('confirmed/filter', 'OrderController@filterConfirmed')->name('.filterConfirmed');
                Route::get('unconfirmed/sort', 'OrderController@sortUnconfirmed')->name('.sortUnconfirmed');
                Route::get('confirmed/sort', 'OrderController@sortConfirmed')->name('.sortConfirmed');
                Route::get('show/{order}', 'OrderController@show')->name('.show');
                Route::get('confirm/{order}', 'OrderController@confirm')->name('.confirm');
                Route::delete('delete/{order}', 'OrderController@destroy')->name('.destroy');
                Route::get('analyse', 'OrderController@getAnalyse')->name('.getAnalyse');
                Route::get('analyse/user', 'OrderController@analyse')->name('.analyse');
            });
        });
    }
}

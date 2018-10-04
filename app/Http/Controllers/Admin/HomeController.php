<?php

namespace Lava\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Lava\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }

    /**
     * generate routes
     */
    public static function routes()
    {
        return Route::group([
            'prefix' => 'admin',
            'namespace' => 'Admin',
        ], function () {
            Route::name('admin')->group(function () {
                Route::get('/', 'HomeController@index')->name('.home');
            });
        });
    }
}

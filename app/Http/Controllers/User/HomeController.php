<?php

namespace Lava\Http\Controllers\User;

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
        $this->middleware('user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.home');
    }

    /**
     * Generate routes
     */
    public static function routes()
    {
        return Route::group([
          'prefix' => 'user',
          'namespace' => 'User',
        ], function () {
            Route::name('user')->group(function () {
                Route::get('/', 'HomeController@index')->name('.home');
            });
        });
    }
}

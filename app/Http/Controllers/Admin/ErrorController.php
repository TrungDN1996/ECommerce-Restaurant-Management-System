<?php

namespace Lava\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Lava\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class ErrorController extends Controller
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
     * show 404 error page
     *
     * @return
     */
    public function error404($message)
    {
        return view('admin.errors.404')->with('message', $message);
    }

    /**
     * generate routes
     */
    public static function routes()
    {
        return Route::group([
            'prefix' => 'admin/errors',
            'namespace' => 'Admin',
        ], function () {
            Route::name('admin.errors')->group(function() {
                Route::get('/404/{message}', 'ErrorController@error404')->name('.404');
            });
        });
    }
}

<?php

namespace Lava\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Lava\Http\Controllers\Controller;
use Lava\Model\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user');
    }

    /**
     * show user profile
     * @return [type] [description]
     */
    public function index()
    {
        $user = Auth::user();
        return view('user.profile.index')->with('user', $user);
    }

    /**
     * Edit user profile
     *
     * @return [type] [description]
     */
    public function edit()
    {
        $user = Auth::user();
        return view('user.profile.edit')->with('user', $user);
    }

    /**
     * update user profile
     *
     * @return [type] [description]
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $user = User::find(Auth::id())->update($data);
        return redirect()->route('user.profile')
                         ->withSuccess('Update Profile Successfully');
    }

    /**
     * user.profile.* routes
     *
     * @return [type] [description]
     */
    public static function routes()
    {
        Route::group([
            'prefix' => 'user/profile',
            'namespace' => 'User'
        ], function(){
            Route::name('user.profile')->group(function(){
                Route::get('/', 'ProfileController@index');
                Route::get('/edit', 'ProfileController@edit')->name('.edit');
                Route::put('/update', 'ProfileController@update')->name('.update');
            });
        });
    }
}

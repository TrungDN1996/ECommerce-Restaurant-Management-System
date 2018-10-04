<?php

namespace Lava\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Lava\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\validator;
use Lava\Model\User;
use Lava\Rules\NoSpace;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Show all users include admin
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '>=', 1)->paginate(25);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Return response a list of all soft deleted users with ajax
     *
     * @return \Illuminate\Http\Response
     */
    public function inactivate()
    {
        $users = User::onlyTrashed()->get();
        return view('admin.user.inactivate', compact('users'));
    }

    /**
     * Show data of specific user
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! $user = User::withTrashed()->where('id', $id)->first()) {
            $message = 'User not found';
            return redirect()->route('admin.errors.404', $message);
        }
        return view('admin.user.show')->with('user', $user);
    }

    /**
     * create new user
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * store new user data created by admin
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array_slice($request->all(), 1);

        $validator = $this->validatorCreate($request);

        if ($validator->fails()) {
            return redirect()->route('admin.user.create')
                             ->withErrors($validator)
                             ->withData($data)
                             ->withInput();
        }

        User::create($data);

        return redirect()->route('admin.user.create')
                         ->withSuccess('Created user successfully');
    }

    /**
     * Edit specific user info
     *
     * @var $id int
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! $user = User::withTrashed()->where('id', $id)->first()) {
            $message = 'User not found';
            return redirect()->route('admin.errors.404', $message);
        }
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update edited user data
     *
     * @var $id int
     * @var $request \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array_slice($request->all(), 2);

        $validator = $this->validatorUpdate($request, $id);

        if ($validator->fails())
            return redirect()->route('admin.user.edit', $id)
                             ->withErrors($validator)
                             ->withData($data)
                             ->withInput();

        User::withTrashed()->where('id', $id)->update($data);

        return redirect()->route('admin.user.show', $id)
                         ->withSuccess('Edited User Successfully');
    }

    /**
     * Store new uploaded avatar of specific user by admin
     *
     * @var id int
     * @var $request \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function updateAvatar(Request $request, $id)
    {
        $this->validatorAvatar($request);

        if ($request->hasFile('avatar')) {

            /**
             * get extension
             * set image name as user_id_avatar.extension
             */
            $user = User::find($id);
            $exs = $request->avatar->extension();
            $name = 'user_'.$id.'_avatar.'.$exs;

            /**
             * remove current avatar
             */
            $current_name = array_slice(explode('/', $user->avatar), -1);
            $delete = Storage::delete('public/avatar/'.$current_name[0]);

            /**
             * Store new avatar
             */
            $request->avatar->storeAs('public/avatar/', $name);
            $user->avatar = 'storage/avatar/'.$name;
            $user->save();

            return redirect()->route('admin.user.show', $id)
                             ->withSuccess('Changed avatar successfully');
        } else {
            return redirect()->route('admin.user.show', $id)
                             ->withErrors('No file Selected');
        }
    }

    /**
     * Active user
     *
     * @return
     */
    public function activate($id)
    {
        if (! $user = User::find($id))
            return redirect()->route('admin.errors.404')
                             ->withMessage('User Not Found');

        if ($user->activate !== 0)
            return redirect()->route('admin.user.show', $id)
                             ->withMessage('User has already been actived');

        $user->activate = 1;
        $user->save();

        return redirect()->route('admin.user.show', $id)
                         ->withSuccess('Activated User Successfully !');
    }

    /**
     * Deactivate User
     *
     * @return
     */
    public function deActivate($id)
    {
        if(! $user = User::find($id))
            return redirect()->route('admin.errors.404')
                             ->withMessage('User Not Found');

        if($user->activate == 0)
            return redirect()->route('admin.user.show', $id)
                             ->withMessage('User has already been deactivated');
        $user->activate = 0;
        $user->save();

        return redirect()->route('admin.user.show', $id)
                         ->withSuccess('Deactivated User Successfully');
    }

    /**
     * Destroy : softDelete user
     *
     * @var $id int
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();
        return redirect()->route('admin.user')
                         ->withSuccess('User has been successfully deleted');
    }

    /**
     * forceDestroy: permantaly delete user
     *
     * @var $id int
     * @return \Illuminate\Http\Response
     */
    public function forceDestroy($id)
    {
        $user = User::withTrashed()->find($id);

        $user->forceDelete();

        return redirect()->route('admin.user')
                         ->withSuccess('User has been permanently deleted');
    }

    /**
     * restore soft deleted user
     *
     * @var $id int
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->first();

        $user->restore();

        return redirect()->route('admin.user.show', $id)
                         ->withSuccess('Restored user Successfully');
    }

    /**
     * Show reset password form
     *
     * @return
     */
    public function showPasswordResetForm($id)
    {
        if (! $user = User::find($id)->first())
            return redirect()->route('admin.errors.404')
                             ->withMessage('Reset Password: User Not Found');

        return view('admin.user.resetPassword')->with('user', $user);
    }

    /**
     * Reset password action
     *
     * @return
     */
    public function resetPassword(Request $request, $id)
    {
        $validator = $this->validatorResetPassword($request, $id);

        if ($validator->fails()) {
            return redirect()->route('admin.user.showPasswordResetForm', $id)
                             ->withErrors($validator)
                             ->withInput();
        }

        if (! $user = User::find($id)->first())
            return redirect()->route('admin.errors.404')
                             ->withMessage('Reset Password: User Not Found');
        $data = $request->all();
        $user->password = Hash::make($data['password']);
        $user->save();
        return redirect()->route('admin.user.show', $id)
                         ->withSuccess('Changed password successfully');
    }

    /**
     * validate create user info
     *
     * @var $request \Illuminate\Http\Request
     * @return array
     */
    public function validatorCreate(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|string',
            'username' => [
                'required',
                'string',
                'unique:users',
                new NoSpace,
            ],
            'email' => [
                'required',
                'email',
                'unique:users',
                new NoSpace,
            ],
            'password' => [
                'required',
                'string',
                'confirmed',
                new NoSpace,
            ],
            'role' => [
                'required',
                Rule::in(['user', 'admin']),
            ],
        ]);
    }

    /**
     * validator update user info
     *
     * @return
     */
    public function validatorUpdate(Request $request, $id)
    {
        $data = $request->all();
        return $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'username' => [
                'required',
                'string',
                'unique:users,username,'.$id,
                new NoSpace,
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email,'.$id,
                new NoSpace,
            ],
            'address' => 'string',
            'phone' => 'string|max:15',
            'status' => [
                'required',
                'string',
                Rule::in(['new', 'old', 'loyal']),
            ],
            'type' => [
                'required',
                'string',
                Rule::in(['local', 'traveller']),
            ],
            'role' => [
                'required',
                'string',
                Rule::in(['user', 'admin']),
            ],
        ]);
    }

    /**
     * validate uploaded avatar
     *
     * @var $request \Illuminate\Http\Request
     * @return array
     */
    public function validatorAvatar(Request $request)
    {
        return $request->validate([
            // 'avatar' => 'required|image|mimes:jpeg,png|dimensions:min_width=250,min_height=250,max_width=1000,max_height=1000',
            'avatar' => [
                'required',
                'image',
                'mimes:jpeg,png',
                'dimensions:min_width=250,min_height=250,max_width=1000,max_height=1000'
            ],
        ]);
    }

    /**
     * validate reset password
     */
    public function validatorResetPassword(Request $request, $id)
    {
        return Validator::make($request->all(),[
            'password' => [
                'required',
                'string',
                'confirmed',
                new NoSpace,
            ],
        ]);
    }

    /**
     * search
     *
     * @return
     */
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required',
        ]);
        $data =$request->all();

        $users = User::where('name', 'like', '%'.$data['search'].'%')
                     ->orWhere('username', 'like', '%'.$data['search'].'%')
                     ->orWhere('email', 'like', '%'.$data['search'].'%')
                     ->orWhere('phone', 'like', '%'.$data['search'].'%')
                     ->orWhere('address', 'like', '%'.$data['search'].'%');
        if (empty($users->get()->toArray()))
            return redirect()->route('admin.user')
                             ->withMessage('No Record Found')
                             ->withSearch($data['search']);
        $users = $users->paginate(30);
        return view('admin.user.index')->with('users', $users)
                                       ->withSearch($data['search']);
    }

    /**
     * filter user with ajax
     *
     * @return
     */
    public function filter(Request $request)
    {
        $validator = $this->validatorFilter($request);

        if ($validator->fails())
            return redirect()->route('admin.user')
                             ->withErrors($validator)
                             ->withInput();

        $data = $request->all();

        switch ($data['select']) {
            case 'active' :
                $users = User::where('id', '>=', 1);
            break;
            case 'deleted':
                $users = User::onlyTrashed();
            break;
            case 'all':
                $users = User::withTrashed();
            break;
        }

        switch ($data['role']) {
            case 'all':
            break;
            default :
                $users = $users->where('role', $data['role']);
            break;
        }

        switch ($data['activate']) {
            case 'all':
            break;
            default:
                $users = $users->where('activate', $data['activate']);
            break;
        }

        switch ($data['status']) {
            case 'all':
            break;
            default:
                $users = $users->where('status', $data['status']);
            break;
        }

        switch ($data['type']) {
            case 'all':
            break;
            default :
                $users = $users->where('type', $data['type']);
            break;
        }

        switch ($data['year']) {
            case 'all':
            break;
            default:
                $year = $data['year'];
                $users = $users->whereRaw("year(created_at) = '$year'");
            break;
        }

        switch ($data['month']) {
            case 'all':
            break;
            default:
                $month = $data['month'];
                $users = $users->whereRaw("month(created_at) = '$month'");
            break;
        }

        switch ($data['day']) {
            case 'all':
            break;
            default:
                $day = $data['day'];
                $users = $users->whereRaw("day(created_at) ='$day'");
            break;
        }

        if (empty($users->get()->toArray()))
            return "No Record Found";

        $users = $users->paginate(15);

        switch ($data['select']) {
            case 'active' :
                return view('admin.user.filter.active')->with('users', $users)
                                                       ->with('select', $data['select'])
                                                       ->with('role', $data['role'])
                                                       ->with('activate', $data['activate'])
                                                       ->with('status', $data['status'])
                                                       ->with('type', $data['type'])
                                                       ->with('year', $data['year'])
                                                       ->with('month', $data['month'])
                                                       ->with('day', $data['day']);
            break;
            case 'deleted':
            return view('admin.user.filter.deleted')->with('users', $users)
                                                   ->with('select', $data['select'])
                                                   ->with('role', $data['role'])
                                                   ->with('activate', $data['activate'])
                                                   ->with('status', $data['status'])
                                                   ->with('type', $data['type'])
                                                   ->with('year', $data['year'])
                                                   ->with('month', $data['month'])
                                                   ->with('day', $data['day']);
            break;
            case 'all':
            return view('admin.user.filter.all')->with('users', $users)
                                                   ->with('select', $data['select'])
                                                   ->with('role', $data['role'])
                                                   ->with('activate', $data['activate'])
                                                   ->with('status', $data['status'])
                                                   ->with('type', $data['type'])
                                                   ->with('year', $data['year'])
                                                   ->with('month', $data['month'])
                                                   ->with('day', $data['day']);
            break;
        }
    }

    /**
     * Filter Month in Year
     */
     public function filterMonth(Request $request)
     {
         $request->validate([
             'year' => 'required',
         ]);

         $data = $request->all();

         switch ($data['year']) {
             case 'all':
                 $months = '<option value="all">All Months</option>';
                 for ($i = 12; $i >= 1; $i--) {
                     $months = $months.'<option value="'.$i.'">'.$i.'</option>';
                 }
                 return $months;
             break;
             default:
                 $year = $data['year'];
                 $monthsRaw = User::selectRaw('month(created_at) month')
                                  ->whereRaw("year(created_at) = '$year'")
                                  ->groupBy('month')
                                  ->orderByRaw('min(created_at) desc')
                                  ->get()
                                  ->toArray();
                 $months = '<option value="all">All Months</option>';
                 foreach ($monthsRaw as $key => $val) {
                     $months = $months.'<option value="'.$val["month"].'">'.$val["month"].'</option>';
                 }
                 return $months;
             break;
         }
     }
    /**
     * Filter Day in Month
     */
     /**
      * filter all day of specific month
      */
     public function filterDay(Request $request)
     {
         $data = $request->all();

         $request->validate([
             'month' => 'required',
         ]);

         switch ($data['month']) {
             case 'all':
                 $days = '<option value="all">All Days</option>';
                 for ($i = 31; $i >= 1; $i--) {
                     $days = $days.'<option value="'.$i.'">'.$i.'</option>';
                 }
                 return $days;
             break;
             default:
                 $month = $data['month'];
                 $daysRaw = User::selectRaw('day(created_at) day')
                                ->whereRaw("month(created_at) = '$month'")
                                ->groupBy('day')
                                ->orderByRaw('min(created_at) desc')
                                ->get()
                                ->toArray();
                 $days = '<option value="all">All Days</option>';
                 foreach ($daysRaw as $key => $val) {
                     $days = $days.'<option value="'.$val["day"].'">'.$val["day"].'</option>';
                 }
                 return $days;
             break;
         }
     }

    /**
     * validate for filter
     *
     * @return
     */
    public function validatorFilter(Request $request)
    {
        $yearsRaw = User::selectRaw('year(created_at) year')
                    ->groupBy('year')
                    ->orderByRaw('min(created_at) desc')
                    ->get()
                    ->toArray();
        $years = ["all"];
        $months = ["all"];
        $days = ["all"];
        foreach ($yearsRaw as $key => $val)
        {
            $years[] = $val["year"];
        }
        for ($i = 12; $i >= 1; $i--) {
            $months[] = $i;
        }
        for ($i = 31; $i >= 1; $i--) {
            $days[] = $i;
        }
        return Validator::make($request->all(),[
            'select' => [
                'required',
                Rule::in(['all', 'active', 'deleted']),
            ],
            'role' => [
                'required',
                Rule::in(['all', 'user', 'admin']),
            ],
            'activate' => [
                'required',
                Rule::in(['all', 1, 0]),
            ],
            'status' => [
                'required',
                Rule::in(['all', 'new', 'old', 'loyal']),
            ],
            'type' => [
                'required',
                Rule::in(['all', 'local', 'traveller']),
            ],
            'year' => [
                'required',
                Rule::in($years),
            ],
            'month' => [
                'required',
                Rule::in($months),
            ],
            'day' => [
                'required',
                Rule::in($days),
            ]
        ]);
    }

    /**
     * bulk action
     *
     * @return
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => [
                'required',
                Rule::in(['activate', 'deactivate', 'destroy', 'restore', 'forceDelete']),
            ],
        ]);
        $raw = $request->all();
        $action = $raw['action'];
        $data = array_slice($raw, 2);
        $count = 0;

        switch ($action)
        {
            case 'activate':
                foreach ($data as $key => $val) {
                    if ($this->bulkActivate($val))
                        $count++;
                }
                $message = 'Activated '.$count.' users !';
            break;

            case 'deactivate':
                foreach ($data as $key => $val) {
                    if ($this->bulkDeActivate($val))
                        $count++;
                }
                $message = 'Deactivated '.$count.' users !';
            break;

            case 'destroy':
                foreach ($data as $key => $val) {
                    if ($this->bulkDestroy($val))
                        $count++;
                }
                $message = 'Deleted '.$count.' users !';
            break;

            case 'restore':
                foreach ($data as $key => $val) {
                    if ($this->bulkRestore($val))
                        $count++;
                }
                $message = 'Restored '.$count.' users !';
            break;

            case 'forceDelete': // TODO: forceDelete a user
                foreach ($data as $key => $val) {
                    if ($this->bulkForceDelete($val))
                        $count++;
                }
                $message = 'Force Deleted '.$count.' users !';
            break;
        }

        if ($count == 0)
            return redirect()->route('admin.user')
                             ->withWarning('No Records were applied');

        return redirect()->route('admin.user')
                         ->withMessage($message);
    }

    /**
     * bulk activate
     *
     * @return boolean
     */
    public function  bulkActivate($id)
    {
        if (! $user = User::find($id))
            return false;
        if ($user->activate !== 0)
            return false;

        $user->activate = 1;
        $user->save();

        return true;
    }

    /**
     * bulk deactivate
     *
     * @return boolean
     */
    public function bulkDeActivate($id)
    {
        if (! $user = User::find($id))
            return false;
        if ($user->activate == 0)
            return false;

        $user->activate = 0;
        $user->save();

        return true;
    }

    /**
     * bulk destroy
     */
    public function bulkDestroy($id)
    {
        if (! $user = User::find($id))
            return false;

        $user->delete();
        return true;
    }

    /**
     * bulk restore
     *
     * @return boolean
     */
    public function bulkRestore($id)
    {
        if (! $user = User::onlyTrashed()->where('id', $id))
            return false;
        $user->restore();
        return true;
    }

    /**
     * bulk force delete
     *
     * @return boolean
     */
    public function bulkForceDelete($id)
    {
        if (! $user = User::withTrashed()->find($id))
            return false;
        $user->forceDelete();
        return true;
    }

    /**
     * activate - Deactivate by activate-checkbox
     * using Ajax
     *
     * @param integer $id
     */
    public function activateAjax(Request $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);

        if (! isset($data["action"]))
            return false;
        switch ($data["action"]) {
            case "activate":
                if ($user->activate !== 0)
                    return false;
                $user->activate = 1;
                $user->save();

                return "Activate Successfully";
            break;
            case "deactivate":
                if ($user->activate == 0)
                    return false;
                $user->activate = 0;
                $user->save();

                return "Deactivate Successfully";
            break;
            default:
                return false;
            break;
        }
    }

    /**
     * Create Routes
     */
    public static function routes()
    {
        return Route::group([
            'prefix' => 'admin/user',
            'namespace' => 'Admin',
        ], function () {
            Route::name('admin.user')->group(function () {
                Route::get('/', 'UserController@index');
                Route::get('/{id}/show', 'UserController@show')->name('.show');
                Route::get('/{id}/edit', 'UserController@edit')->name('.edit');
                Route::put('/{id}', 'UserController@update')->name('.update');
                Route::put('/{id}/avatar', 'UserController@updateAvatar')->name('.updateAvatar');
                Route::get('/create', 'UserController@create')->name('.create');
                Route::post('/store', 'UserController@store')->name('.store');
                Route::post('/{id}/activate', 'UserController@activate')->name('.activate');
                Route::post('/{id}/deActivate', 'UserController@deActivate')->name('.deActivate');
                Route::delete('/{id}', 'UserController@destroy')->name('.destroy');
                Route::delete('/{id}/force', 'UserController@forceDestroy')->name('.forceDestroy');
                Route::post('/{id}/restore', 'UserController@restore')->name('.restore');
                Route::get('/search', 'UserController@search')->name('.search');
                Route::get('/{id}/reset', 'UserController@showPasswordResetForm')->name('.showPasswordResetForm');
                Route::post('/{id}/reset', 'UserController@resetPassword')->name('.resetPassword');
                Route::get('/filter', 'UserController@filter')->name('.filter');
                Route::post('/filter/month', 'UserController@filterMonth')->name('.filter.month');
                Route::post('/filter/day', 'UserController@filterDay')->name('.filter.day');
                Route::post('/bulkAction', 'UserController@bulkAction')->name('.bulkAction');
                Route::post('/{id}/activateAjax', 'UserController@activateAjax')->name('.activateAjax');
                Route::get('/{id}/order', 'UserController@order')->name('.order'); // TODO route('admin.user.order') - show list order
            });
        });
    }
}

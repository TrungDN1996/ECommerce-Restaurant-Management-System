<?php

namespace Lava\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Lava\Http\Controllers\Controller;
use Lava\Model\Service;
use Lava\Model\Order;
use Lava\Model\OrderDetail;
use Lava\Http\Providers\AppServiceProvider;
use Validator;
use DB;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        //dd($services);
        return view('admin.service.index')->with('services', $services);
    }

    // create a service
    public function create()
    {
    	return view('admin.service.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make(
            $data,
            [
                'name' => 'required'
            ],
            [
                'name.required' => 'The name is required'
            ]
        );

        if($validator->fails()) {
            return redirect()
                ->route('admin.service.create')
                ->withErrors($validator)
                ->withInput();
        }

        $service = Service::create($data);
        //dd($service);
        return redirect()
            ->route('admin.service', $service->id)
            ->withSuccess('Create service success');
    }

    //edit a service
    public function edit($id)
    {
        $service = Service::find($id);
        //dd($service);
        return view('admin.service.edit')->with('service', $service);

    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        //dd($data);
        $validator = Validator::make(
            $data,
            [
                'name' => 'required'
            ],
            [
                'required' => 'The :attributes is required'
            ]
        );

        if($validator->fails()){
            return redirect()->route('admin.service.edit', $id)
            ->withErrors($validator)
            ->withInput();
        }

        $service = Service::find($id);
        $service->update($data);
        return redirect()
            ->route('admin.service', $service->id)
            ->withSuccess('Update service success');
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();
        return redirect()
            ->route('admin.service')
            ->withSuccess('Delete service success');
    }

    public static function routes()
    {
        return Route::group([
                    'prefix' => 'admin/service',
                    'namespace' => 'Admin',
                ], function(){
                        Route::name('admin.service')->group(function(){
                            Route::get('/', 'ServiceController@index');
                            Route::get('/create', 'ServiceController@create')->name('.create');
                            Route::post('/', 'ServiceController@store')->name('.store');
                            Route::get('/edit/{id}', 'ServiceController@edit')->name('.edit');
                            Route::put('/edit/{id}', 'ServiceController@update')->name('.update');
                            Route::delete('/{id}', 'ServiceController@destroy')->name('.destroy');
            });
        });
    }

}

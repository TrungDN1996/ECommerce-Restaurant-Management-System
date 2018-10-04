<?php

namespace Lava\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Lava\Http\Controllers\Controller;
use Lava\Model\File;
use Illuminate\Support\Facades\Route;

class FileController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Show all files
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::all()->sortByDesc('created_at');

        return view('admin.media.index', compact('files'));
    }

    /**
     * Shall all files with filter
     */
    public function filter(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'year'  => 'required',
            'month' => 'required',
            'day' => 'required',
        ]);
        $data = $request->all();

        switch ($data['type'])
        {
            case 'all':
                $files = File::where('id', '>=', 1);
            break;
            case 'mine':
                $files = File::where('user_id', Auth::user()->id);
            break;
            default:
                $files = File::where('type', $data['type']);
            break;
        }

        switch ($data['year']) {
            case 'all':
            break;
            default:
                $year = $data['year'];
                $files = $files->whereRaw("year(created_at) = '$year'");
            break;
        }

        switch ($data['month']) {
            case 'all':
            break;
            default:
                $month = $data['month'];
                $files = $files->whereRaw("month(created_at) = '$month'");
            break;
        }
        switch ($data['day']) {
            case 'all':
            break;
            default:
                $day = $data['day'];
                $files = $files->whereRaw("day(created_at) = '$day'");
            break;
        }

        if (empty($files->get()->toArray()))
            return 'No Records found';

        $files = $files->orderBy('created_at', 'desc')->get();

        return view('admin.media.filter', compact('files'));
    }

    /**
     * filter all month of specific year
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
                $monthsRaw = File::selectRaw('month(created_at) month')
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
                $daysRaw = File::selectRaw('day(created_at) day')
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
     * Display specific file
     */
    public function show($id)
    {
        $file = File::find($id);
        return view('admin.media.show', compact('file'));
    }

    /**
     * Store uploaded file
     */
    public function store(Request $request)
    {
        /**
         * validate file uploaded
         */
        $this->validator($request);

        if ($request->hasFile('file')) {

            /**
            * Get infomation of file
            */
            $extension = $request->file->extension();
            $name = $request->file->hashName();
            $size = static::formatSizeUnits($request->file->getSize());
            $clientName = $request->file->getClientOriginalName();

            if ($extension == 'jpeg' || $extension == 'png') {

                $type = 'image';
                $url = 'storage/uploaded/image/'.$name;
                $request->file->store('public/uploaded/image');

            } elseif ($extension == 'mp4') {

                $type = 'video';
                $url = 'media/image/video-default.png';
                $request->file->store('public/uploaded/video');

            } else {

                $type = 'audio';
                $url = 'media/image/audio-default.png';
                $request->file->store('public/uploaded/audio');

            }

            File::create([
                'name' => $name,
                'url' => $url,
                'size' => $size,
                'type' => $type,
                'client_name' => $clientName,
                'user_id' => Auth::id(),
            ]);
            return redirect()->route('admin.file')
                             ->withSuccess('File is uploaded successfully');
        }
    }

    /**
     * valide Uploaded files
     */
    public function validator(Request $request)
    {
        return $request->validate([
            'file' => 'required|mimes:jpeg,png,mp4,mpga',
        ]);
    }

    /**
     * Delete files
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::find($id);

        if ($this->delete_uploaded_file($file)):

            return redirect()->route('admin.file')
                             ->withSuccess('File has been deleted successfully');

        else:

            return redirect()->route('admin.file')
                             ->withDanger('Error Can not delete this file');

        endif;

    }

    /**
     * Bulk Destroy
     *
     * @return \Illuminate\Http\Response
     */
    public function bulkDestroy(Request $request)
    {
        $data = array_slice($request->all(), 2);

        foreach ($data as $key => $id)
        {
            $file = File::find($id);
            if (! $this->delete_uploaded_file($file))
                return redirect()->route('admin.file')
                                 ->withDanger('Error: can not delete file: ID = '.$id.' - File Name = '.$file->name);
        }

        return redirect()->route('admin.file')
                         ->withSuccess('Bulk Deleted Successfully');
    }

    /**
     * Delete file in storage/app/public/uploaded
     */
    public function delete_uploaded_file($file)
    {
        switch ($file->type) {
            case 'image':
                if (Storage::delete('public/uploaded/image/'.$file->name))
                    $file->delete();
                return true;
            break;
            case 'audio':
                if (Storage::delete('public/uploaded/audio/'.$file->name))
                    $file->delete();
                    return true;
            break;
            case 'video':
                if (Storage::delete('public/uploaded/video/'.$file->name))
                    $file->delete();
                    return true;
            break;
        }
        return false;
    }


    /**
     * Function format file size units
     */
     public static function formatSizeUnits($bytes)
     {
         if ($bytes >= 1073741824)
         {
             $bytes = number_format($bytes / 1073741824, 2) . ' GB';
         }
         elseif ($bytes >= 1048576)
         {
             $bytes = number_format($bytes / 1048576, 2) . ' MB';
         }
         elseif ($bytes >= 1024)
         {
             $bytes = number_format($bytes / 1024, 2) . ' KB';
         }
         elseif ($bytes > 1)
         {
             $bytes = $bytes . ' bytes';
         }
         elseif ($bytes == 1)
         {
             $bytes = $bytes . ' byte';
         }
         else
         {
             $bytes = '0 bytes';
         }

         return $bytes;
     }

    /**
     * Generate routes
     */
    public static function routes()
    {
        return Route::group([
            'prefix' => 'admin/file',
            'namespace' => 'Admin',
        ], function () {
            Route::name('admin.file')->group(function () {
                Route::get('/', 'FileController@index');
                Route::post('/', 'FileController@store')->name('.store');
                Route::post('/filter', 'FileController@filter')->name('.filter');
                Route::get('/{id}/show', 'FileController@show')->name('.show');
                Route::delete('/{id}/destroy', 'FileController@destroy')->name('.destroy');
                Route::delete('/bulkDestroy', 'FileController@bulkDestroy')->name('.bulkDestroy');
                Route::post('/filter/month', 'FileController@filterMonth')->name('.filter.month');
                Route::post('/filter/day', 'FileController@filterDay')->name('.filter.day');
            });
        });
    }
}

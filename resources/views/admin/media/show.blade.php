<div class="closeAdminmediaShowItem" >
    <a href="javascript:void(0)" class="text-white" id="closeAdminmediaShowItem"><i class="fas fa-times" style="font-size: 1.5em"></i></a>
</div>
<div class="col-12 px-100 py-50 position-relative" style="background-color: #131313;">
    @switch ($file->type)
        @case('image')
            <img src="{{ asset($file->url) }}" alt="No Image" class="img-fluid">
        @break
        @case('video')
            <video src="{{ asset('storage/uploaded/video/'.$file->name) }}" poster="{{ asset('media/500.png') }}" controls style="width: 100%; height: auto;">
                Your Browser doesn't support HTML5 video
            </video>
        @break
        @case('audio')
            <audio src="{{ asset('storage/uploaded/audio/'.$file->name) }}" controls style="width: 100%;"></audio>
        @break
        @default
            No Records Found
    @endswitch
</div>
<div class="col-12">
    <div class="row m-0 p-3">
        <table class="table table-hover col-auto m-auto w-800" id="FileInfoTable">
            <thead>
                <tr>
                    <th scope="col" colspan="2" class="text-center"><h3>File Info</h3></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">ID</th>
                    <td>{{ $file->id }}</td>
                </tr>
                <tr>
                    <th scope="row">File Type</th>
                    <td>{{ $file->type }}</td>
                </tr>
                <tr>
                    <th scope="row">Client name:</th>
                    <td>{{ $file->client_name }}</td>
                </tr>
                <tr>
                    <th scope="row">Size:</th>
                    <td>{{ $file->size }}</td>
                </tr>
                <tr>
                    <th scope="row">Url:</th>
                    <td>{{ asset($file->url) }}</td>
                </tr>
                <tr>
                    <th scope="row">User ID</th>
                    <td>{{ $file->user_id }}</td>
                </tr>
                <tr>
                    <th scope="row">Delete</th>
                    <td>
                        <form action="{{ route('admin.file.destroy', $file->id) }}" method="post" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

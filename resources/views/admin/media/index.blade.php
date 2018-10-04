@extends('admin.layouts.master')

@section('content')
    <div class="row mx-0 p-3">
        <a href="#uploadFormCollapse" class="btn btn-info" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="uploadFormCollapse" >
            Add New
        </a>
    </div>
    @include('elements.alert')
    <div class="row collapse p-3 mx-0" id="uploadFormCollapse">
        <div class="col">
            <form action="{{ route('admin.file.store') }}" enctype="multipart/form-data" method="POST" class="text-center">
                @csrf
                <div class="form-group text-center">
                    <label for="file" class="btn btn-info" role="button">Upload File</label>
                    <span class="file-name"></span>
                    <input type="file" name="file" id="file">
                    @if ($errors->has('file'))
                        <span class="invalid-feedback" rol="alert">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                    @endif
                </div>
                <input type="submit" value="Save File" class="btn btn-primary">
            </form>
        </div>
    </div>
    @include('admin.media.selectBox')
    <div class="row mx-0 p-3" id="adminMediaListAllFiles">
        <ul class="list-inline mb-0">
            @foreach ($files as $file)
                <li class="list-inline-item mb-2 mr-2">
                    <a href="javascript:void(0)" class="displayAdminMediaShowItem d-block">
                        <div class="imageWrap" data-url="{{ route('admin.file.show', $file->id) }}">
                            <input type="checkbox" name="file_{{ $file->id }}" class="image-checkbox w-0" value="{{ $file->id }}" form="bulkDestroyFileForm" hidden>
                            <img src="{{ asset($file->url) }}" alt="No Image" style="width: 140px; height: 140px" class="adminMediaImages">
                            <i class="fas fa-check d-none adminMediaImageCheckBoxIcon" style="font-size: 1.5rem;"></i>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div id="adminMediaShowItem" class="row mx-0 d-none"></div>
@endsection

@section('js')
	<script src="{{ asset("js/admin/media.js") }}"></script>
    <script type="text/javascript">
        var url = "{{ route('admin.file.filter') }}";
        var FilterMonthUrl = "{{ route('admin.file.filter.month') }}";
        var FilterDayUrl = "{{ route('admin.file.filter.day') }}";
    </script>
@endsection

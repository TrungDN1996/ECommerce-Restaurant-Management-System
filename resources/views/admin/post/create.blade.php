@extends('admin.layouts.master')

@section('content')
<div class="row m-0" id="adminPostHeader">
	<div class="col-auto">
		<h1>Create Post</h1>
	</div>
</div>
<div class="row m-0" id="adminPostContentWrap">
	<form action="{{ route('admin.post.store') }}" method="POST" class="col-12 p-0" id="createPostForm">
		@csrf
		<input type="hidden" name="action" value="publish" id="actionPostInput">
		<div class="row m-0">
			<div class="col-12 col-md-9" id="adminPostContent">
				@include('admin.post.create.content')
			</div>
			<div class ="col-12 col-md-3" id="adminPostSideBar">
				@include('admin.post.create.sidebar')
			</div>
		</div>
	</form>
</div>
<div class="d-none" id="addMediaContainer">
	@include('admin.post.create.media.addMedia')
</div>
@endsection

@section('css')
	<link rel="stylesheet" href="{{ asset('css/admin/post.css') }}">
@endsection
@section('js')
	<script src="{{ asset('js/library/tinymce/js/tinymce/tinymce.min.js') }}"></script>
	<script src="{{ asset('js/admin/post.js') }}"></script>
	<script src="{{ asset('js/admin/media.js') }}"></script>
	<script type="text/javascript" style="color:#333;">
		var createSlugFunction = "{{ route('admin.post.slug') }}";
		var uploadImageToContent = "{{ route('admin.post.create.upload.image') }}";
		var getCateListUrl = "{{ route('admin.post.create.getCateList') }}";
		var token = "{{ csrf_token() }}";
		var url = "{{ route('admin.file.filter') }}";
		var FilterMonthUrl = "{{ route('admin.file.filter.month') }}";
        var FilterDayUrl = "{{ route('admin.file.filter.day') }}";
	</script>
@endsection

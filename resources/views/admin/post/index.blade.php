@extends ('admin.layouts.master')

@section('content')

	@include('admin.post.elements.header')
	@include('elements.alert')
	@include('admin.post.elements.selectBox')
	@include('admin.post.elements.content')

@endsection


@section('js')
	<script src="{{ asset('js/admin/postIndex.js') }}"></script>
@endsection

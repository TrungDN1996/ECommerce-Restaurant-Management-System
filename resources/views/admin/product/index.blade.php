@extends ('admin.layouts.master')

@section('content')

	@include('admin.product.elements.header')
	@include('elements.alert')
	@include('admin.product.elements.selectBox')
	@include('admin.product.elements.content')

@endsection


@section('js')
	<script src="{{ asset('js/admin/product.js') }}"></script>
@endsection
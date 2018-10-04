@extends('admin.layouts.master')

@section('content')

	@include('admin.category.elements.header')
	@include('elements.alert')
	@include('admin.category.elements.content')

@endsection

@section('js')
	<script src="{{asset('js/admin/category.js')}}"></script>
@endsection
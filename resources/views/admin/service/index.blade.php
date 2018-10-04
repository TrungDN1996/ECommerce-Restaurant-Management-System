@extends('admin.layouts.master')

@section('content')
	
	@include('admin.service.elements.header')
	@include('elements.alert')
	@include('admin.service.elements.content')

@endsection

@section('js')
	<script src="{{ asset('js/admin/service.js') }}"></script>
@endsection
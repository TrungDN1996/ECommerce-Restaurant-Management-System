@extends('site.layouts.master')

@section('content')
<div class="container">

  	<!-- Filter -->
	@include('site.page.menu.filter')

	<!-- Heading Title -->
	@include('site.page.menu.header')

	<div class="row">

		<!-- Sidebar -->
		<div class="col-md-2" style="padding: 0;">
		   @include('site.sidebar.product')
		</div>

		{{-- Content --}}
		<div class="col-md-9 col-md-offset-1">
			@include ('site.page.menu.content')
		</div>

	</div>
</div>

@endsection

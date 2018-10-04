@extends('site.layouts.master')

@section('content')
	<div class="blog">
		<div class="container">
			<div class="agile-blog-grids">
				<!-- Left Content -->
				<div class="col-md-8 agile-blog-grid-left">
					@include('site.category.post')
				</div>
				<!-- End Left Content -->

				<!-- Right Content -->
				<div class="col-md-3 col-md-offset-1 agile-blog-grid-right">
					@include('site.sidebar.post')
				</div>
				<!-- End Right Content -->
			</div>
		</div>
	</div>
@endsection
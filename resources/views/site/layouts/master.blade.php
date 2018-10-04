<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Lava Restaurant</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{ asset('css/site/library/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/site/library/fonts-bs3.css') }}">
		<link rel="stylesheet" href="{{ asset('css/site/library/templatemo_style-bs3.css') }}">
		<link rel="stylesheet" href="{{ asset('css/site/library/templatemo_misc-bs3.css') }}">
		<link rel="stylesheet" href="{{ asset('css/site/library/flexslider-bs3.css') }}">
		<link rel="stylesheet" href="{{ asset('css/site/library/testimonails-slider-bs3.css') }}">
		<link rel="stylesheet" href="{{ asset('css/site/library/breadcrumb-bs3.css') }}">
		<link rel="stylesheet" href="{{ asset('css/site/library/search_box-bs3.css') }}">
		<link rel="stylesheet" href="{{ asset('css/site/library/notification-button.css') }}">
		<link rel="stylesheet" href=" //maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css ">
		<link rel="stylesheet" href="{{ asset('css/site/custom.css') }}">
		@yield('css')
	</head>
	<body>
		<div id="container">
			<!-- Header -->
			<header>
				<!-- Navbar -->
				@include('site.elements.top_nav')
				@include('site.elements.main_nav')
				<!--End Navbar -->
			</header>
			<!-- End Header -->

			<!-- Page Heading -->
			<div id="page-heading">
				<!-- Slide -->
				@if(in_array(Request::route()->getName(),
						[
							'home',
							'menu',
							'menu.category.show',
							'menu.post.show',
							'menu.filter',
						])
					)
					@include('site.elements.slide')
				@endif
				<!-- End Slide -->

				<!-- Search-box -->
				@if(in_array(Request::route()->getName(),
						[
							'menu',
							'menu.search',
							'menu.category.show',
							'menu.filter'
						])
					)
					@include('site.elements.search_box')
				@endif
				<!-- End Search-box -->

			</div>
			<!-- End Page Heading -->

			<!-- Content -->
			<div id="content">
				@yield('content')
			</div>
			<!-- End Content -->

			<!-- Footer -->
			<footer>
				@include('site.elements.footer')
			</footer>
			<!-- End Footer -->

		</div>

		<!-- Bootstrap JavaScript -->
		<script src="{{ asset('js/site/library/popper.min.js') }}"></script>
	    <script src="{{ asset('js/site/library/jquery.min.js') }}"></script>

  		<script src="{{ asset('js/site/library/bootstrapi.min.js') }}"></script>
		<script src="{{ asset('js/site/library/plugins-bs3.js') }}"></script>
		<script src="{{ asset('js/site/library/main-bs3.js') }}"></script>
		@yield('js')
	</body>
</html>

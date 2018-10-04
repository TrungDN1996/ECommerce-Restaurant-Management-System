@extends('site.layouts.master')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				@if(Session::has('Success'))
					<div class="row">
						<div class="col-md-4 alert alert-success">
						{{ Session::get('Success') }}
						</div>
					</div>
				@endif
				<div class="leave-comment">
						<div class="leave-one">
							<h4>Leave a message</h4>
						</div>
				</div>		
				@include('site.form.message')
			</div>
			<div class="col-md-3 col-md-offset-1">
				@include('site.sidebar.info_contact')
			</div>				
		</div>
	</div>
@endsection
@extends('admin.layouts.master')

@section('content')

<div class="row m-0">
	<div class="col-sm-7 offset-3">
		<h3 class="text-center">Add Service</h3>
		<hr>
		<div>
			<a class="" href="{{route('admin.service')}}">Back to view</a>	
		</div>
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error}}</li>
					@endforeach
				</ul>
			</div>
		@endif
		{!! Form::open (['url' => '/admin/service']) !!}
			<div class="form-group">
				<label for=""><strong>Name </strong><span style="color:red">*</span></label>
				<input type="text" name="name" placeholder="please enter name" class="form-control" value="">
			</div>	
			<input type="submit" name="" class="btn btn-primary" value="Add Service">
		{!! Form::close() !!}
	</div>
</div>

@endsection
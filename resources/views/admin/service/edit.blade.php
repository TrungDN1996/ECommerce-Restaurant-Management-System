@extends ('admin.layouts.master')

@section('content')

<div class="row m-0">
	<div class="col-sm-7 offset-3">
		<h3 class="text-center">Update service</h3>
		<hr>
		<a class="" href="{{route('admin.service')}}">Back to view</a>
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error}}</li>
					@endforeach
				</ul>
			</div>
		@endif
		{!! Form::model($service, ['url' => '/admin/service/edit/'.$service->id, 'method' => 'PUT']) !!}
			<div class="form-group">
				<label for=""><strong>Name </strong><span style="color:red">*</span></label>
				<input type="text" name="name" class="form-control" placeholder="please enter name" value="{{old('name', isset($service->name) ? $service->name : '')}}">
			</div>	
			<input type="submit" name="sub" class="btn btn-primary" value="Update Service">
		{!!Form::close()!!}
	</div>
</div>

@endsection
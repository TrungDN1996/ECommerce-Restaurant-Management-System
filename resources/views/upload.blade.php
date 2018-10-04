@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-md-auto mx-auto">
			<form action="{{ route('file.store') }}" enctype="multipart/form-data" method="post">
				@csrf
				<div class="form-group">
					<label for="file"></label>
					<input type="file" name="file" id="file" class="form-control">
				</div>
				<div class="form-group">
					<input type="submit" value="Upload" class="form-control">
				</div>
			</form>
		</div>
	</div>
@endsection

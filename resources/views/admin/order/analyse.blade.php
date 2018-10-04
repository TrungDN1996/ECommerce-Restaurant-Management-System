@extends('admin.layouts.master')

@section('content')
	<div class="row m-0 p-3 align-items-center bg-white ">
		<div class="col-12 col-sm-auto pb-3 pt-0 py-md-2 text-center">
			<div style="background-color: green; width: 130x;"><strong>Analyse Order/Month</strong></div>
			<form action="{{ route('admin.order.analyse') }}" method="get" role="form">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Year" name="year" value="{{ Request('year') }}">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Month" name="month" value="{{ Request('month') }}">
				</div>
				<div class="form-group">
					{!! Form::select('orderType',['table' => 'Table', 'online' => 'Online'], null, ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::select('subject',['user' => 'User', 'product' => 'Product'], null, ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Analyse</button>
				</div>
			</form>
	    </div>
	    <div class="col-auto">
	    	@if(isset($analyseUser))
				@include('admin.order.analyseUser')
			@elseif(isset($analyseProduct))
				@include('admin.order.analyseProduct')
			@endif
	    </div>
	</div>
@endsection


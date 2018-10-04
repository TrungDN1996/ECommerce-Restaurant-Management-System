@extends ('admin.layouts.master')

@section('content')

<div class="row m-0">
	<div class="col-sm-12">
		<h1>List products has been deleted</h1>
	</div>
	<div class="col-sm-12">
		<a href="{{ route('admin.product') }}">Back to view</a>
	</div>

	<div class="col-sm-12">
		<p>There are <span><strong>{{$showDeletes->total()}}</strong></span> products in trash</p>
	</div>
	
</div>
<div class="row m-0" id="list-product">
	<table class="table table-bordered" id="list-search">
		<thead>
			<tr class="text-center">
				<th>Index</th>
				<th>Name</th>
				<th>Description</th>
				<th>Type</th>
				<th>Price</th>
				<th>Caterory</th>
				<th>Deleted</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php $stt=1; ?>
    	@foreach ($showDeletes as $showDelete)
    		<tr>
    		 	<td class="text-center">{{ $stt++ }}</td>
    		 	<td>{{ $showDelete['name'] }}</td>
				<td>{{ $showDelete['description']}}</td>
				<td>{{ $showDelete['type']}}</td>
				<td class="text-center">{{$showDelete['price'] }}</td>
				<td class="text-center">{{ $showDelete->category['name'] }}</td>
				<td>{{ $showDelete['deleted_at'] }}</td>
    		 	<td><a href="{{ route('admin.product.restore', $showDelete->id)}}" class="btn btn-warning">Restore</a></td>
				<td>
					<form action="{{ route('admin.product.forceDelete', $showDelete->id)}}" method="POST" onsubmit="return confirm('Are you sure?');">
						<input type="hidden" name="_method" value="DELETE">
	    				<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-danger">Delete</button>
					</form>		
				</td>
     		</tr>
		@endforeach	
		</tbody>
	</table>
	<div>
		{{ $showDeletes->links()}}
	</div>
</div>

@endsection
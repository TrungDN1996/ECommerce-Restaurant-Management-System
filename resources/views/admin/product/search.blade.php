
<table class="table table-bordered" >
	<thead>
		<tr class="text-center">
			<th>Index</th>
			<th>Name</th>
			<th>Description</th>
			<th>Type</th>
			<th>Status</th>
			<th>Price</th>
			<th>Caterory</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	<tbody>
	<?php $stt=1; ?>
	@foreach ($searchs as $search)
		<tr>
		 	<td class="text-center">{{ $stt++ }}</td>
		 	<td>{{ $search->name }}</td>
			<td>{{ $search->description}}</td>
			<td>{{ $search->type}}</td>
			<td class="text-center">{{ $search->status}}</td>
			<td class="text-center">{{ $search->price}}</td>
			<td>{{ $search->category['name'] }}</td>
		 	<td class="text-center"><a href="{{ route('admin.product.edit', $search->id )}}" class="btn btn-warning">Edit</a></td>
			<td class="text-center">
				<form action="{{ route('admin.product.destroy', $search->id)}}" method="POST" onsubmit="return confirm('Are you sure?');">
					<input type="hidden" name="_method" value="DELETE">
    				<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button type="submit" class="btn btn-danger">Delete</button>
				</form>		
			</td>
 		</tr>
	@endforeach	
	</tbody>
</table>


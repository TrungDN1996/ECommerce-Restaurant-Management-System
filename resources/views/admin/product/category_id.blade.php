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
	@foreach ($category as $item)
		<tr>
		 	<td class="text-center">{{ $stt++ }}</td>
		 	<td>{{ $item->name }}</td>
			<td>{{ $item->description}}</td>
			<td>{{ $item->type}}</td>
			<td class="text-center">{{ $item->status}}</td>
			<td class="text-center">{{ $item->price}}</td>
			<td>{{ $item->category->name }}</td>
		 	<td><a href="{{ route('admin.product.edit', $item->id )}}" class="btn btn-warning">Edit</a></td>
			<td>
				<form action="{{ route('admin.product.destroy', $item->id)}}" method="POST" onsubmit="return confirm('Are you sure?');">
					<input type="hidden" name="_method" value="DELETE">
    				<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button type="submit" class="btn btn-danger">Delete</button>
				</form>		
			</td>
 		</tr>
	@endforeach	
	</tbody>
</table>
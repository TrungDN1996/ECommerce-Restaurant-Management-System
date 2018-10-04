
<table class="table table-bordered">
	<thead>
		<tr class="text-center">
			<th>STT</th>
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
	@foreach ($prods as $type)
		<tr>
		 	<td class="text-center"><h4>{{ $stt++ }}</h4></td>
		 	<td>{{ $type['name'] }}</td>
			<td>{{ $type['description']}}</td>
			<td>{{ $type['type']}}</td>
			<td class="text-center">{{ $type['status']}}</td>
			<td class="text-center">{{ $type['price']}}</td>
			<td class="text-center">{{ $type['category_id'] }}</td>
		 	<td><a href="{{ route('admin.product.edit', $type['id'] )}}" class="btn btn-warning">Edit</a></td>
			<td>
				<form action="{{ route('admin.product.destroy', $type['id'])}}" method="POST" onsubmit="return confirm('Are you sure?');">
					<input type="hidden" name="_method" value="DELETE">
    				<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button type="submit" class="btn btn-danger">Delete</button>
				</form>		
			</td>
 		</tr>
	@endforeach	
	</tbody>
</table>


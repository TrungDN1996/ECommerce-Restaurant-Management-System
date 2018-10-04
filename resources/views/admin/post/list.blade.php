
<table class="table table-bordered">
	<thead>
		<tr class="text-center">
			<th>STT</th>
			<th>Type</th>
			<th>Title</th>
			<th>Published</th>
			<th>Product</th>
			<th>User</th>
			<th>Category</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	<tbody>
	<?php $stt=1; ?>
	@foreach ($types as $type)	
		<tr>
		 	<td class="text-center">{{ $stt++ }}</td>
		 	<td class="text-center">{{ $type->type }}</td>
		 	<td>{{ $type->title}}</td>
		 	<td class="text-center">{{ $type->published }}</td>
		 	<td>{{ $type->product['name'] }}</td>
		 	<td>{{ $type->user['name'] }}</td>
		 	<td>{{ $type->category['name'] }}</td>
		 	<td><a href="" class="btn btn-warning">Edit</a></td>
			<td>
				<form action="" method="POST" onsubmit="return confirm('Are you sure?');">
					<input type="hidden" name="_method" value="DELETE">
    				<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button type="submit" class="btn btn-danger">Delete</a>
				</form>		
			</td>
 		</tr>
	@endforeach	
	</tbody>
</table>	

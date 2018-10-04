<?php $stt=1; ?>
@foreach ($category_id as $id)	
	<tr>
	 	<td class="text-center">{{ $stt++ }}</td>
	 	<td class="text-center">{{ $id->type }}</td>
	 	<td>{{ $id->title}}</td>
	 	<td class="text-center">{{ $id->published }}</td>
	 	<td>{{ $id->product['name']}}</td>
	 	<td>{{ $id->user->name}}</td>
	 	<td>{{ $id->category->name }}</td>
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

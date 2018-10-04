<?php $stt=1; ?>
@foreach($searchs as $search)	
	<tr>
	 	<td class="text-center">{{ $stt++ }}</td>
	 	<td class="text-center">{{ $search->type }}</td>
	 	<td>{{ $search->title}}</td>
	 	<td class="text-center">{{ $search->published }}</td>
	 	<td>{{ $search->product['name']}}</td>
	 	<td>{{ $search->user['name']}}</td>
	 	<td>{{ $search->category['name'] }}</td>
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
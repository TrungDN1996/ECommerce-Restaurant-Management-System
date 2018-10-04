<?php $stt=1; ?>
@foreach ($getType as $item)
	<tr>
	 	<td class="text-center">{{ $stt++ }}</td>
	 	<td>{{$item['name']}}</td>
	 	<td>{{$item['description']}}</td>
	 	<td class="text-center">{{$item['type']}}</td>
	 	<td class="text-center">{{$item['parent_id']}}</td>
	 	<td class="text-center"><a href="{{ route('admin.category.edit', $item['id'])}}" class="btn btn-warning">Edit</a></td>
		<td class="text-center">
			<form action="{{ route('admin.category.destroy', $item['id'])}}" method="POST" onsubmit="return confirm('Are you sure?');">
				<input type="hidden" name="_method" value="DELETE">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button type="submit" class="btn btn-danger">Delete</a>
			</form>		
		</td>
	</tr>
@endforeach	

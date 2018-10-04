<div class="row m-0">
	<table class="table table-bordered" id="list_type">
		<thead>
			<tr class="text-center">
				<th>Index</th>
				<th>Name</th>
				<th>Description</th>
				<th>Type</th>
				<th>Parent_id</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php $stt=1; ?>
		@foreach ($category as $item)
			<tr>
			 	<td class="text-center">{{ $stt++ }}</td>
			 	<td>{{$item->name}}</td>
			 	<td>{{$item->description}}</td>
			 	<td class="text-center">{{$item->type}}</td>
			 	<td class="text-center">{{$item->parent_id}}</td>
			 	<td class="text-center"><a href="{{ route('admin.category.edit', $item->id)}}" class="btn btn-warning">Edit</a></td>
				<td class="text-center">
					<form action="{{ route('admin.category.destroy', $item->id)}}" method="POST" onsubmit="return confirm('Are you sure?');">
						<input type="hidden" name="_method" value="DELETE">
	    				<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-danger">Delete</a>
					</form>		
				</td>
	 		</tr>
		@endforeach	
		</tbody>
	</table>
</div>
<div class="row m-0">
	{{ $category->links()}}
</div>
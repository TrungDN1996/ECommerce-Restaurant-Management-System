<div class="row m-0">
	<table class="table table-bordered" id="list_type">
		<thead>
			<tr class="text-center">
				<th>Index</th>
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
    	@foreach ($posts as $post)
    		<tr>
    		 	<td class="text-center">{{ $stt++ }}</td>
    		 	<td  class="text-center">{{ $post->type }}</td>
    		 	<td>{{ $post->title}}</td>
    		 	<td class="text-center">{{ $post->published }}</td>
    		 	<td>{{ $post->product['name']}}</td>
    		 	<td>{{ $post->user['name']}}</td>
    		 	<td>{{ $post->category['name'] }}</td>
    		 	<td><a href="" class="btn btn-warning">Edit</a></td>
				<td>
					<form action="{{ route('admin.post.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
<div class="center">
	{{ $posts->links() }}
</div>

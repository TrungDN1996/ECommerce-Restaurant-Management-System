<div class="row m-0">
	<table class="table table-bordered">
		<thead>
			<tr class="text-center">
				<th>Index</th>
				<th>Name</th>
				<th>Created at</th>
				<th>Updated at</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php $stt = 1 ;?>
		@foreach($services as $service )
			<tr>
				<td class="text-center">{{ $stt++ }}</td>
				<td>{{ $service->name}}</td>
				<td class="text-center">{{ $service->created_at}}</td>
				<td class="text-center">{{ $service->updated_at}}</td>
				<td class="text-center"><a href="{{ route('admin.service.edit', $service->id)}}" class="btn btn-warning">Edit</a></td>
				<td class="text-center">
					<form action="{{route('admin.service.destroy', $service->id)}}" method="POST" onsubmit="return confirm('Are you sure?');">
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
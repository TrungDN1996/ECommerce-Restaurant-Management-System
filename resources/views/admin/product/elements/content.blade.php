<div class="row m-0" id="list-product">
	<table class="table table-bordered" id="list-search">
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
    	@foreach ($products as $product)
    		<tr>
    		 	<td class="text-center">{{ $stt++ }}</td>
    		 	<td>{{ $product->name }}</td>
				<td>{{ $product->description}}</td>
				<td>{{ $product->type}}</td>
				<td class="text-center">{{ $product->status}}</td>
				<td class="text-center">{{ $product->price}}</td>
				<td>{{ $product->category['name'] }}</td>
    		 	<td><a href="{{ route('admin.product.edit', $product->id )}}" class="btn btn-warning">Edit</a></td>
				<td>
					<form action="{{ route('admin.product.destroy', $product->id)}}" method="POST" onsubmit="return confirm('Are you sure?');">
						<input type="hidden" name="_method" value="DELETE">
	    				<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-danger">Delete</button>
					</form>		
				</td>
     		</tr>
		@endforeach	
		</tbody>
	</table>
	<div class="center">
		{{ $products->links() }}
	</div>	
</div>
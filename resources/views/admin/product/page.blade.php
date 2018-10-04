<div class="row m-0" >
	<table class="table table-bordered" id="list-page" >
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
    	@foreach ($pages as $page)
    		<tr>
    		 	<td class="text-center">{{ $stt++ }}</td>
    		 	<td>{{ $page->name }}</td>
				<td>{{ $page->description}}</td>
				<td>{{ $page->type}}</td>
				<td class="text-center">{{ $page->status}}</td>
				<td class="text-center">{{ $page->price}}</td>
				<td>{{ $page->category->name }}</td>
    		 	<td><a href="{{ route('admin.product.edit', $page->id )}}" class="btn btn-warning">Edit</a></td>
				<td>
					<form action="{{ route('admin.product.destroy', $page->id)}}" method="POST" onsubmit="return confirm('Are you sure?');">
						<input type="hidden" name="_method" value="DELETE">
	    				<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-danger">Delete</button>
					</form>		
				</td>
     		</tr>
		@endforeach	
		</tbody>
	</table>
	<div class="row m-0">
		{{ $pages->links() }}
	</div>
</div>
<div class="row m-0">
	<p>Show <strong>{{count($pages)}}</strong> in total <strong>{{ $pages->total()}} </strong>record</p>
</div>


<script type="application/javascript">
    $(function () {
        $('.pagination a').click(function (e) {
            // Prevent page redirect
            e.preventDefault();
            // Get link from tag a
            var link = $(this).attr('href');
            // Send request
            $.ajax({
                url: link,
                type: 'GET',
                success: function(response){
                    $('#list-page').html(response);
                },
                error: function(errors){
                    console.log(errors);
                }
            });
        })
    });
</script>
@extends('admin.layouts.master')

@section('content')
	<div class="row m-0 p-3 flex-column flex-md-row text-center">
		<div class="col-auto pb-3">
			<h2>New Orders</h2>
		</div>
		<div class="col-12 col-md-auto ml-md-auto">
			<form action="">
				<div class="form-group">
					<input type="text" name="search" class="form-control" id="search" placeholder="search by user name">
				</div>
			</form>
		</div>
	</div>

	@if(Session::has('Success'))
		<div class="row">
			<div class="col-md-4 alert alert-success">
			{{ Session::get('Success') }}
				
			</div>
		</div>
	@endif

	<div class="row m-0 p-3 align-items-center bg-white ">
		<div class="col-12 col-sm-auto pb-3 pt-0 py-md-2 text-center">
			<div style="background-color: green; width: 120px;"><strong>Filter By Type</strong></div>
			<select class="form-control filterByAjax" id="type" name="type">
				<option value="table">Table</option>
				<option value="online">Online</option>
			</select>
	    </div>

	    <div class="col-12 col-sm-auto pb-3 pt-0 py-md-2 text-center">
			<div style="background-color: green; width: 130x;"><strong>Sort By</strong></div>
			<select class="form-control filterByAjax" id="sort" name="sort">
				<option value="0">A-Z</option>
				<option value="1">Lastest Date</option>
				<option value="2">Newest Date</option>
			</select>
	    </div>
	</div>

	<div class="row m-0 px-50" id="adminUserTableList">
		<table class="table table-hover" id="list_type">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">User</th>
					<th scope="col">Total</th>
					<th scope="col">Type</th>
					<th scope="col">Status</th>
					<th scope="col">Created at</th>
					<th scope="col">Detail</th>
					<th scope="col">Confirm</th>
					<th scope="col">Delete</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($orders as $order)
				<tr>
					<td scope="row">{{ $order->id }}</td>
					<td>{{ $order->user->name }}</td>
					<td>{{ $order->total }} USD</td>
					<td>{{ $order->type }}</td>
					<td>{{ $order->status }}</td>
					<td>{{ date_format($order->created_at, 'h:m d/m/y') }}</td>
					<td><a href="{{ route('admin.order.show', $order->id) }}" style="text-decoration: none;">Detail</a></td>
					<td>
						<a href="{{ route('admin.order.confirm', $order->id) }}"><button type="button" class="btn btn-primary">Confirm</button></a>
					</td>
					<td>
						<form action="{{ route('admin.order.destroy', $order->id) }}" method="post" onsubmit="return confirm('Are you sure?')">
							@csrf
							@method('delete')
							<input type="hidden" name="destroy" value="0">
							<input type="submit" value="Delete" role="button" class="btn btn-danger">
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $orders->links() }}
	</div>

@endsection

@section('js')
	<script>
	   	$(document).ready(function() {

	   		$("#search").keyup(function(event) {
	   			var search = $(this).val();
	   			$.get('/admin/order/unconfirmed/search', {'search':search}, function(data){
                    $("tbody").html(data);
                });
	   		});
	   		$("select[name = type]").change(function(){
                var type = $(this).val();
                // alert(type);
                $.get('/admin/order/unconfirmed/filter', {'type':type}, function(data){
                    $("tbody").html(data);
                })
	        });
	        $("select[name = sort]").change(function(){
                var sort = $(this).val();
                // alert(sort);
                $.get('/admin/order/unconfirmed/sort', {'sort':sort}, function(data){
                    $("tbody").html(data);
                })
	        });
		});
   	</script>
@endsection

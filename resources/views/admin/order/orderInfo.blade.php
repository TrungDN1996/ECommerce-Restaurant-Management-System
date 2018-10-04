@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-md-3">
			<a href="{{ route('admin.order.index') }}" style="text-decoration: none;"><i class="fas fa-angle-double-left"></i>Go back New Orders</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<a href="{{ route('admin.order.showConfirmedorders') }}" style="text-decoration: none;"><i class="fas fa-angle-double-left"></i>Go back Confirmed Orders</a>
		</div>
	</div>

	<div class="row m-0 p-3 flex-column flex-md-row text-center">
		<div class="col-auto pb-3">
			<h2>Order Detail</h2>
		</div>
	</div>

	{{-- @include('admin.order.selectBox') --}}

	<div class="row">
		<div class="col-md-5">
			<h4 style="margin-left: 50px;">User: <span>{{ $orderInfo->user->name }}</span></h4>
			<h4 style="margin-left: 50px;">Type: <span>{{ $orderInfo->type }}</span></h4>
			@if(isset($orderInfo->service))
			
				<h4 style="margin-left: 50px;">Service: <span>{{ $orderInfo->service->name }}</span></h4>
			
			@elseif(isset($orderInfo->coupon))
			
				<h4 style="margin-left: 50px;">Coupon: <span>{{ $orderInfo->coupon->name }}</span></h4>
			
			@endif
			<h6 style="margin-left: 50px;">Date: {{ date_format($orderInfo->created_at, 'd/m/y') }}</h6>
		</div>
	</div>

	<div class="row m-0 px-50" id="adminOrderTableList">
		<table class="table table-hover">
			<thead>
				<tr>
					<th scope="col">Product</th>
					<th scope="col" class="text-center">Type</th>
					<th scope="col" class="text-center">Price</th>
					<th scope="col" class="text-center">Quantity</th>
				</tr>
			</thead>
			<tbody>
				
				@foreach($orderDetails as $orderDetail)

					<tr>
						<td>{{ $orderDetail->product->name }}</td>
						<td class="text-center">{{ $orderDetail->product->type }}</td>
						<td class="text-center">{{ $orderDetail->price }} USD</td>
						<td class="text-center">{{ $orderDetail->quantity }}</td>
					</tr>

				@endforeach

			</tbody>
		</table>
		<div class="row">
			{{ $orderDetails->links() }}
		</div>
	</div>

@endsection


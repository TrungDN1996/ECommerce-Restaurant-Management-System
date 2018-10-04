@extends('user.layouts.master')

@section('content')

	<div class="row">
		<div class="col-md-3">
			<a href="{{ route('menu') }}" style="text-decoration: none;"><i class="fas fa-angle-double-left"></i>Continue Shopping</a>
		</div>
	</div>

    <!-- Success Message -->
    @if (session()->has('success'))

        <div class="row" style="text-align: center;">
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        </div>

    @endif
    <!-- End Success Message -->
    
	<!-- Page Title -->
    @if(Cart::instance('shopping')->count() > 0)

	<div class="row" style="margin: 50px 0;">
		<div class="col-md-12 text-center">
			<h2>Your Shopping Cart   <a href="#"><i class="fas fa-shopping-cart"></i></a></h2>
		</div>
	</div>
	<!-- End Page Title -->
	
	<!-- Items List -->

    <div class="col-md-11 col-md-offset-1">
        <table class="table table-hover">
            <thead style="background-color: #71B2EE;">
                <tr>
                    <th class="text-center">Product</th>
                    <th>Quantity</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Remove</th>
                    <th class="text-center">Save</th>
                </tr>
            </thead>
            <tbody>
				<tr>

                	@foreach($cartItems as $item)

                	<td class="row">
                		<div class="col-md-2 col-md-offset-1">
                        @if($item->thumbnail == null)
                			<img src="{{ asset('images/img_4157.jpg')}}" alt="" style="width: 60px; height: 50px;">
                        @else
                            <img src="#" alt="{{ $item->model->thumbnail }}">
                        @endif
                		</div>
                		<div class="col-md-8" style="text-align: center'">
                			<strong>{{ $item->name }}</strong>
                		</div>

                	</td>
                    <td style="text-align: center">
                    	<form action="{{ route('user.cart.update') }}" method="POST" accept-charset="utf-8">
                    		@method('PUT')
                    		{{ csrf_field() }}
                    		<input type="hidden" name="rowId" value="{{ $item->rowId }}">
                    		<div class="row">
                    			<input style="width: 70px; height: 38px;" type="number" class="col-auto text-center p-0 m-0" name="qty" id="exampleInputEmail1" value="{{ $item->qty }}">
                			<button type="submit" class="btn btn-light"><a href="#"><i style="font-size: 1.5rem;" class="fas fa-edit"></i></a></button>
                    		</div>

                    	</form>
                    </td>
                    <td class="text-center"><strong>{{ number_format($item->price) }} USD</strong></td>
                    <td class="text-center"><strong>{{ number_format($item->subtotal()) }} USD</strong></td>
            		<td>

						<!-- Remove button -->
            			<form action="{{ route('user.cart.destroy') }}" method="POST" accept-charset="utf-8" class="text-center">
            				@method('DELETE')
            				{{ csrf_field()}}
            				<input type="hidden" name="rowId" value="{{ $item->rowId}}">
            				<button type="submit" class="btn btn-light" onclick="return confirm('Are you sure?')"><a href="#"><i class="fas fa-trash-alt" style="color: red; font-size: 1.5rem;"></i></a></button>
            			</form>

            		</td>
            		<td>

						<!-- Save Button -->
            			<form action="{{ route('user.cart.saveFavorite') }}" method="POST" accept-charset="utf-8" class="text-center">
            				{{ csrf_field()}}
            				<input type="hidden" name="rowId" value="{{ $item->rowId}}">
            				<button type="submit" class="btn btn-light"><a href="#"><i class="fas fa-save" style="color: green; font-size: 1.5rem;"></i></a></button>
            			</form>

            		</td>
             	</tr>

             	@endforeach

            </tbody>
        </table>
    </div>
	   <!-- End Items List -->

    	<!-- Review Order -->
    <div class="row" style="margin-top: 100px; margin-bottom: 50px;">
    	<div class="col-md-4" style="margin-left: 60%;">
		    <div class="panel panel-default">
                <div class="panel-heading text-center" style="background-color: #EFA8A8;">
                    <h4>Review Order</h4>
                </div>
		        <div class="panel-body">
	                <div class="col-md-12">
	                    <strong>Total</strong>
	                    <div class="pull-right">
                            <span>{{ Cart::instance('shopping')->count() }} item(s)</span>
                        </div>
	                </div>
	                <div class="col-md-12">
	                    <strong>Price</strong>
	                    <div class="pull-right"><span>{{ number_format(Cart::instance('shopping')->subtotal()) }}</span> USD</div>
	                    <hr>
	                </div>
		        </div>
                <div class="row">
                        <a href="{{ route('user.cart.getOrder') }}" style="text-decoration: none;">
                            <button type="button" class="btn btn-primary btn-lg btn-block">
                                <strong>Checkout</strong>
                            </button>
                        </a>
                </div>
	    	</div>
    	</div>
	</div>
    <!-- End Review Order -->

    @else
        <div class="row" style="margin-left: 400px;">
            <h2>No item in your cart</h2>
        </div>
    @endif

@endsection

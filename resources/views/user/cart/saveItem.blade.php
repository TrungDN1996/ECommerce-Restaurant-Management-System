@extends('user.layouts.master')

@section('content')

	<div class="row">
		<div class="col-md-3">
			<a href="{{ route('menu') }}" style="text-decoration: none;"><i class="fas fa-angle-double-left"></i>Continue Shopping</a>
		</div>
	</div>

	<!-- Page Title -->
    @if(Cart::instance('favorite')->count() > 0)

	<div class="row" style="margin: 50px 0;">
		<div class="col-md-12 text-center">
			<h2>Your Favorite Cart</h2>
		</div>
	</div>
	<!-- End Page Title -->

	<!-- Success Message -->
	@if(Session::has('success'))

		<div class="row" style="margin-left: 10px;">
			<div class="alert alert-success">{{ Session::get('success') }}</div>
		</div>

	@endif
	<!-- End Success Message -->

	<!-- Items List -->

    <div class="col-md-11 col-md-offset-1">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-center">Product</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Remove</th>
                    <th class="text-center">Add To Shopping</th>
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
                    <td class="text-center"><strong>{{ number_format($item->price) }} USD</strong></td>
            		<td>

						<!-- Remove Button -->
            			<form action="{{ route('user.cart.destroyFavorite') }}" method="POST" accept-charset="utf-8" class="text-center">
            				@method('DELETE')
            				{{ csrf_field()}}
            				<input type="hidden" name="rowId" value="{{ $item->rowId}}">
            				<button type="submit" class="btn btn-light" onclick="return confirm('Are you sure?')"><a href="#"><i class="fas fa-trash-alt" style="color: red; font-size: 1.5rem;"></i></a></button>
            			</form>
                        <!-- End Remove Button -->

            		</td>
            		<td>

						<!-- Add Button -->
            			<form action="{{ route('user.cart.addFavorite') }}" method="POST" accept-charset="utf-8" class="text-center">
            				{{ csrf_field()}}
            				<input type="hidden" name="rowId" value="{{ $item->rowId}}">
            				<button type="submit" class="btn btn-light"><a href="#"><i class="fas fa-cart-plus" style="color: green; font-size: 1.5rem;"></i></a></button>
            			</form>
                        <!-- End Add Button -->

            		</td>
             	</tr>

             	@endforeach

            </tbody>
        </table>
    </div>

    @else
        <div class="row" style="margin-left: 420px;">
            <h2>No item is saved</h2>
        </div>
    @endif
	<!-- End Items List -->

@endsection

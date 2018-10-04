@extends('user.layouts.master')

@section('content')
    <div class="row m-0" >
        <div class="col-md-12 text-center" style="margin-top: 30px; background-color: #E9EB1B;"><h2>Checkout</h2></div>
    </div>

	<div class="row m-0">
        <div class="col-md-5" id="show-info-user-table-wrap">
            <form action="{{ route('user.cart.order') }}" method="POST">
                @csrf
                <table class="table table-hove">
                    <thead style="background-color: #47ED57;">
                        <th scope="col" colspan="2" class="text-center">Order Details</th>
                    </thead>
                    <tbody style="background-color: #EAE374;">
                    	<tr>
                    		<input type="hidden" name="type" value="online">
                    	</tr>
                        <tr>
                            <th scope="row"><label for="user_id">User</label></th>
                            <td>
                        		<input type="number" name="user_id">

                                <p style="color: red;">
                                    @if($errors->get('user_id'))
                                        @foreach($errors->get('user_id') as $message)
                                        {{ $message }}
                                        @endforeach
                                    @endif
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ship">Ship<span style="color: red;">*</span></label></th>
                            <td>

                                {!! Form::select('ship', ['free' => 'Free', 'fast' => 'Fast'], null, ['placeholder' => 'Pick a ship']) !!}

                                 <p style="color: red;">
                                    @if($errors->get('ship'))
                                        @foreach($errors->get('ship') as $message)
                                        {{ $message }}
                                        @endforeach
                                    @endif
                                </p>
                            </td>
                        </tr>
                        <tr>
                        	<th scope="row"><label for="received-at">Time<span style="color: red;">*</span></label></th>
                        	<td>
                        		<p id="datepairExample">
								    <input type="text" class="date" name="date" value="{{ old('date') }}" placeholder="Date:">
								    <input type="text" class="time" name="time" value="{{ old('time') }}" placeholder="Time:">
                                     <p style="color: red;">
                                        @if($errors->get('date') AND $errors->get('time'))
                                            {{ 'Please enter date and time!'}}
                                        @elseif($errors->get('date'))
                                            @foreach($errors->get('date') as $message)
                                            {{ $message }}
                                            @endforeach
                                        @elseif($errors->get('time'))
                                            @foreach($errors->get('time') as $message)
                                            {{ $message }}
                                            @endforeach
                                        @endif
                                    </p>
								</p>
                        	</td>
                        </tr>
                        <tr>
                        	<th scope="row"><label for="note">Note</label></th>
                        	<td>
                        		<textarea name="note" id="note" rows="4" cols="50"></textarea>
                        	</td>
                        </tr>
                        <tr>
                        	<td></td>
                            <td>
                                <input type="submit" value="Checkout" class="btn btn-primary">
                                <a href="{{ route('user.cart.index') }}" role="button" class="btn btn-danger" onclick="return confirm('Are you sure?')">Cancel</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>

        <div class="col-md-6" style="margin-left: 60px; margin-top: 50px;">
        	<table class="table table-hove">
        		<thead style="background-color: #76BBE2;">
                    <th scope="col" colspan="4" class="text-center">Your Order</th>
                </thead>
                <tbody>

                	@foreach($cartItems as $cartItem)

	                    <tr>
	                        <td>
	                            <div>
	                    			@if($cartItem->thumbnail == null)
                                        <img src="{{ asset('images/img_4157.jpg')}}" alt="" style="width: 60px; height: 50px;">
                                    @else
                                        <img src="#" alt="{{ $cartItem->model->thumbnail }}">
                                    @endif
	                    		</div>
	                        </td>
	                        <td>
	                        	<h6>{{ $cartItem->name }}</h6>
	                        	<span style="color: red;">{{ $cartItem->price }} USD</span>
	                        </td>
	                        <td>
                        		<div class="row">
                        			<input style="width: 50px; height: 38px;" type="number" class="col-auto text-center p-0 m-0" name="qty" id="exampleInputEmail1" value="{{ $cartItem->qty }}" disabled>
                        		</div>
	                        </td>
	                    </tr>

	                @endforeach

                    <tr>
                    	<th colspan="3" style="background-color: #F29B9B;">
                    		<div class="panel panel-default">
						        <div class="panel-body">
					                <div class="col-md-12">
					                    <strong>Total</strong>
					                    <div class="pull-right">
				                            <span>{{ Cart::instance('shopping')->count() }} item(s)</span>
				                        </div>
					                </div>
					                <div class="col-md-12">
					                    <strong>Price</strong>
					                    <div class="pull-right"><span></span>{{ number_format(Cart::instance('shopping')->subtotal()) }} USD</div>
					                </div>
						        </div>
					    	</div>
                    	</th>
                    </tr>
                </tbody>
        	</table>
        </div>
    </div>

@endsection

@section('css')
     <!-- Datepair -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/timepicker@1.11.12/jquery.timepicker.css">
    <!-- End Datepair -->
@endsection

@section('js')
    <!-- Datepair -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/timepicker@1.11.12/jquery.timepicker.js" type="text/javascript"></script>
    <script>
        // initialize input widgets first
        $('#datepairExample .time').timepicker({
            'showDuration': true,
            'timeFormat': 'H:i:s'
        });

        $('#datepairExample .date').datepicker({
            'dateFormat': 'yy-mm-dd',
            'autoclose': true
        });
    </script>
    <!-- End Datepair -->
@endsection

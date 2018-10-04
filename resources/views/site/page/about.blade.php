@extends('site.layouts.master')

@section('content')

    <div class="container">
        <!-- Left Section -->
        <div class="row">
            <div class="col-md-5">
                <img style="width: 560px;" src="{{ asset('images/about01.jpg') }}" alt="">
            </div>
            <div class="col-md-6 col-md-offset-1">
                <h2 class="text-center">Our Company</h2>
                <p style="width: 560px; height: 350px; padding-top: 60px;" class="text-justify">Nulla sodales ut tellus blandit accumsan. Aliquam erat volutpat. Morbi quis vestibulum erat. Nam malesuada lobortis tempus. Fusce fermentum libero fringilla odio pharetra malesuada. Suspendisse potenti. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam ultrices lectus quis consequat fringilla. Mauris non ex et purus sollicitudin tempus vitae quis nisi.</p>
            </div>
        </div>
        <!-- End Left Section -->

        <!-- Right Section -->
        <div class="row" style="margin-top: 100px;">
            <div class="col-md-5">
                <h2 class="text-center">Team Management</h2>
                <p style="width: 560px; height: 350px; padding-top: 60px;" class="text-justify">Suspendisse quis consectetur nisi, vitae consequat sem. In et quam id libero venenatis venenatis. Morbi vitae justo vulputate, auctor augue eu, pulvinar augue. Vestibulum placerat sem eu posuere laoreet. Ut ac ex nec urna maximus tristique interdum eget ipsum. Duis at pharetra neque, ut condimentum ex. Nunc tincidunt magna nec aliquam rhoncus. Morbi a posuere nunc.</p>
            </div>
            <div class="col-md-6 col-md-offset-1">
                <img style="width: 560px;" src="{{ asset('images/about02.jpg') }}" alt="">
            </div>
        </div>
        <!-- End Right Section -->

@endsection
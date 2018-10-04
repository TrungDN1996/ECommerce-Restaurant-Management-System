@extends('site.layouts.master')

@section('content')

	<div id="services">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="heading-section">
	                    <h2>Our Services</h2>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="col-md-3 col-sm-6">
	                <div class="service-item">
	                    <div class="icon">
	                        <i class="glyphicon glyphicon-edit"></i>
	                    </div>
	                    <h4>Book Table</h4>
	                    <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit. Sed arcu  sagittis vel diam in, malesuada malesuada risus. Aenean a sem leoneski.</p>
	                </div>
	            </div>
	            <div class="col-md-3 col-sm-6">
	                <div class="service-item">
	                    <div class="icon">
	                        <i class="glyphicon glyphicon-earphone"></i>
	                    </div>
	                    <h4>Ship Food</h4>
	                    <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit. Sed arcu  sagittis vel diam in, malesuada malesuada risus. Aenean a sem leoneski.</p>
	                </div>
	            </div>
	            <div class="col-md-3 col-sm-6">
	                <div class="service-item">
	                    <div class="icon">
	                        <i class="glyphicon glyphicon-time"></i>
	                    </div>
	                    <h4>Opening Time</h4>
	                    <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit. Sed arcu  sagittis vel diam in, malesuada malesuada risus. Aenean a sem leoneski.</p>
	                </div>
	            </div>
	            <div class="col-md-3 col-sm-6">
	                <div class="service-item">
	                    <div class="icon">
	                        <i class="glyphicon glyphicon-heart"></i>
	                    </div>
	                    <h4>Satisfaction</h4>
	                    <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit. Sed arcu  sagittis vel diam in, malesuada malesuada risus. Aenean a sem leoneski.</p>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	@include('site.elements.recent_news')
@endsection

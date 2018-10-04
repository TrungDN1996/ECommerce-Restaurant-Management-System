<div class="row m-0">
	<div class="col-auto">
		<h1 class="">Product</h1>
	</div>
	<div class="col-auto row align-items-center">
		<a class="btn btn-primary" href="{{ route('admin.product.create')}}">Add Product</a>
	</div>
</div>
<div class="row m-0">
	<div class="col-sm-3">
		<a href="{{ route('admin.product.showDelete')}}" class="btn btn-info">Show Deleted</a>
	</div>
	<div class="col-sm-3 offset-5">
		<input type="text" class="form-control" placeholder="Search..." id="search" name="search" value="{{old('search', isset($product->search) ? $product->search : '')}}">
	</div>
</div>


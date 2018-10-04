@extends ('admin.layouts.master')

@section('content')

<div class="col-lg-7 offset-3">
	<a class="" href="{{route('admin.product')}}">Back to view</a>
	<h2 class="text-center">Update Product</h2>
	<hr>
	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	{!! Form::model($product, ['url'=>'/admin/product/edit/'.$product->id, 'method' => 'PUT']) !!}
		<div class="form-group">
			<label for=""><strong>Category Parent</strong><span style="color:red"> *</span></label>
			<select name="category_id" id="category_id"class="form-control">
				@foreach($cate as $cate_type)
					<option value="{{$cate_type['id']}}" <?php if(old('category_id') == $cate_type['id'] ) echo "selected = 'selected' " ?>>{{ $cate_type['name']}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for=""><strong>Type</strong><span style="color:red"> *</span></label>
			<select name="type" id="type"class="form-control">
				<option value="drink" <?php if($types->type == "drink"  && $types->id == $id) echo "selected = 'selected' "  ?>>drink</option>
				<option value="appetizer" <?php if($types->type == "appetizer"  && $types->id == $id) echo "selected = 'selected' "  ?> >appetizer</option>
				<option value="entree"  <?php if($types->type == "entree" && $types->id == $id) echo "selected = 'selected' "  ?> >entree</option>
				<option value="dessert"  <?php if($types->type == "dessert"  && $types->id == $id) echo "selected = 'selected' "  ?>>dessert</option>
			</select>
		</div>
		<div class="form-group">
			<label for=""><strong>Name</strong><span style="color:red"> *</span></label>
			<input type="text" class="form-control" name="name" placeholder="Please enter name" value="{{old('name', isset($product->name) ? $product->name : '')}}">
		</div>
		<div class="form-group">
			<label for=""><strong>Price</strong><span style="color:red"> *</span></label>
			<input type="text" class="form-control" name="price" placeholder="Please enter price" value="{{old('price', isset($product->price) ? $product->price : '')}}">
		</div>
		<div class="form-group">
			<label for=""><strong>Status</strong><span style="color:red"> *</span></label>
			<select name="status" class="form-control">
				<option value="0" <?php echo "selected='selected'"?>>0</option>
				<option value="1" <?php echo "selected ='selected'"?>>1</option>
			</select>
		</div>
		<div class="form-group">
			<label for="">Description</label>
			<textarea name="description" class="form-control" cols="10" rows="5" value="">{{old('description', isset($product->description) ? $product->description : '')}}</textarea>
		</div>
		<input type="submit" class="btn btn outline-info" value="Update product">
	{!! Form::close() !!}
</div>

@endsection

@section('js')
	<!-- //đổ dữ liệu có quan hệ ra selecbox -->
<script>
$(document).ready(function($) {
 	$("#category_id").change(function(event) {
 		/* Act on the event */
 		var cate = $(this).val();
		//alert(cate);
		$.get('/admin/product/selectBox/select/'+cate, function(data){
			$("#type").html(data);
				
 		});
 	});
});
</script>

@endsection




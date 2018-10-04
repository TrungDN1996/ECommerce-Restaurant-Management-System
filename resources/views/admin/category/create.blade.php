@extends ('admin.layouts.master')

@section ('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-7 offset-3" >
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error}}</li>
						@endforeach
					</ul>
				</div>
				@endif
				<a class="" href="{{route('admin.category')}}">Back to view</a>
				<h2 class="text-center">Add Category</h2>
				<hr>
				<form action="{!! url('/admin/category')!!}" method="POST">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<div class="form-group">
						<label for=""><strong>Category Parent</strong></label>
						<select name="parent" class="form-control" id="category">
							<option value="choose">Choose Category</option>
							<?php category_parent ($categories, 0, $str="--", old("parent", isset($category->parent) ? $category->parent : ""))  ?>
						</select>
					</div>
					<div class="form-group">
						<label for=""><strong>Type:</strong><span style="color:red"> *</span></label>
						<select name="type" class="form-control" id="type">
							<option value="0">Choose Type</option>
							<option value="post" <?php if(old('type') == "post" ) echo "selected = 'selected' "  ?>>post</option>
          					<option value="post_product"  <?php if(old('type') == "post_product" ) echo "selected = 'selected' "  ?> >post_product</option>
         					<option value="product"  <?php if(old('type') == "product" ) echo "selected = 'selected' "  ?> >product</option>
						</select>
					</div>
					<div class="form-group">
						<label for=""><strong>Category Name</strong><span style="color:red"> *</span></label>
						<input type="text" name="name" class="form-control" placeholder="please enter name" value="{{old('name', isset($category->name) ? $category->name : '')}}">
					</div>		
					<div class="form-group">
						<label for=""><strong>Description</strong><span style="color:red"> *</span></label>
						<textarea name="description" class="form-control" cols="10" rows="7" value="">{{old('description', isset($category->description) ? $category->description : '')}}</textarea>
					</div>
					<input type="submit" class="btn btn outline-info" value="Add Category">
				</form>
				
			</div>
		</div>
	</div>
@endsection

@section('js')
<script>
$(document).ready(function($) {
 	$("#category").change(function(event) {
 		/* Act on the event */
 		var cate = $(this).val();
		//alert(cate);
		$.get('/admin/category/categoryparent/type/'+cate, function(data){
			$("#type").html(data);
				
 		});
 	});
});
</script>

@endsection
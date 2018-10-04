<div class="row m-0">
	<div class="col-sm-4">
		<select name="user" id="user" class="form-control">
			<option value="all">User Name</option>
			@foreach($user as $item)
			<option value="{{$item['id']}}">{{$item['name']}}</option>
			@endforeach
		</select>
	</div>
	<div class="col-sm-4">
		<select name="category" id="category" class="form-control">
			<option value="all">Category Name</option>
			<?php category_parent($category);?>
		</select>
	</div>
	<div class="col-sm-4">
		<fieldset class="form-group">
				<select class="form-control" id="type" name="type">
					<option value="all">Choose type</option>
					<option value="post">post</option>
					<option value="post_product">post_product</option>
					<option value="product">product</option>
				</select>
		</fieldset>
	</div>
</div>
<div class="row m-0">
	<div class="col-sm-4">
		<label for="">Show: </label>
		<select name="page" id="page" >	
			<option value="all">All</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
		</select>
	</div>
	<div class="col-sm-4">
		<select name="category" id="category" class="form-control filterByAjax">
			<option value="all">Choose Category</option>
			@foreach ($cate as $type)
				<option value="{{$type['id']}}">{{$type['name']}}</option>
			@endforeach
		</select>
	</div>
	<div class="col-sm-4">
		<select name="product" id="product" class="form-control filterByAjax">
			<option value="all">Product Type</option>
			<option value="drink">Drink</option>
			<option value="appetizer">Appetizer</option>
			<option value="entree">Entree</option>
			<option value="dessert">Dessert</option>
		</select>
	</div>
</div>

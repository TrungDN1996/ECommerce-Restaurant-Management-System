@foreach($results as $result)

<div class="col-md-6" style="height: 370px; margin-bottom: 200px;">
  <div class="thumbnail ">
    <img src="http://placehold.it/400x250/000/fff" alt="..." style="height: 250px; width: 400px;">
    <div class="caption">
      <a href="{{ url('menu/post/product/' . $result->slug) }}"><h3>{{ $result->title }}</h3></a>
      <h2 style="font-size: 20px; font-weight: bold; color: red;">Price: {{ $result->product->price }} $</h2>
      <p>{{ $result->excerpt }}</p>
      <div class="row">
        <div class="col-md-6" style="text-align: right;">
          <div class="glyphicon glyphicon-check"></div>
          <a href="#" class="btn btn-primary " role="button">Shop Now</a> 
        </div>
        <div class="col-md-6">
          <div class="glyphicon glyphicon-shopping-cart"></div>
          <a href="#" class="btn btn-default" role="button">Add To Cart</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endforeach
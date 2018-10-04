<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
    <li data-target="#carousel-example-generic" data-slide-to="4"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">

    @foreach($bestSellers as $bestSeller)

      @switch($bestSeller)
        @case($bestSellers[0])
          <div class="item active">
          @break
        @default
          <div class="item">
          @break
      @endswitch
          @if($bestSeller->thumbnail == null)
            <img style="height: 80vh; width: 100%" src="{{ asset('images/img_2763.jpg') }}" alt="">
          @else
            <img style="height: 80vh; width: 100%" src="#" alt="{{ $bestSeller->thumbnail }}">
          @endif
            <div class="carousel-caption">
              <h1>{{ $bestSeller->name }}</h1>
              <a href="{{ route('menu.post.show', $bestSeller->slug) }}">More</a>
            </div>
          </div>

    @endforeach

  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

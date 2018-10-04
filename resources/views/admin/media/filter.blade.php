<ul class="list-inline mb-0">
    @foreach ($files as $file)
        <li class="list-inline-item mx-3 my-3">
            <img src="{{ asset($file->url) }}" alt="No Image" style="width: 140px; height: 140px">
        </li>
    @endforeach
    <li class="list-inline-item m-3" >
        <a href="#"><img src="{{ asset('media/500.png') }}" alt="No Image" style="width: 140px; height: 140px;" class="adminMediaImages"></a>
    </li>
    <li class="list-inline-item m-3" >
        <a href="#"><img src="{{ asset('media/500.png') }}" alt="No Image" style="width: 140px; height: 140px;" class="adminMediaImages"></a>
    </li>
    <li class="list-inline-item m-3" >
        <a href="#"><img src="{{ asset('media/500.png') }}" alt="No Image" style="width: 140px; height: 140px;" class="adminMediaImages"></a>
    </li>
    <li class="list-inline-item m-3" >
        <a href="#"><img src="{{ asset('media/500.png') }}" alt="No Image" style="width: 140px; height: 140px;" class="adminMediaImages"></a>
    </li>
    <li class="list-inline-item m-3" >
        <a href="#"><img src="{{ asset('media/500.png') }}" alt="No Image" style="width: 140px; height: 140px;" class="adminMediaImages"></a>
    </li>
    <li class="list-inline-item m-3" >
        <a href="#"><img src="{{ asset('media/500.png') }}" alt="No Image" style="width: 140px; height: 140px;" class="adminMediaImages"></a>
    </li>
</ul>

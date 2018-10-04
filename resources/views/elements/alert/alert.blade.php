@if ($errors->any())
    <div class="text-center alert alert-danger mb-0">
        <ul class="list-unstyled mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session()->has('success'))
    <div class="text-center alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
@if (session()->has('message'))
    <div class="text-center alert alert-info">
        {{ session()->get('message') }}
    </div>
@endif
@if (session()->has('warning'))
    <div class="text-center alert alert-warning">
        {{ session()->get('warning') }}
    </div>
@endif

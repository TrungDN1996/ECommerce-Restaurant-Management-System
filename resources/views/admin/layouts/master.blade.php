<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Loger Nam</title>
    <link rel="stylesheet" href="{{ asset('css/library/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/library/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" type="text/css">
    @yield('css')
</head>
<body>
<div class="container-fluid p-0">
    <div class="row m-0" id="topNav-container">
        <div class="col-12 p-0">
            <div class="row m-0" id="topNav">
                @include('admin.layouts.topNav')
            </div>
        </div>
    </div>
    <div class="row m-0" id="content-container">
        <div id="sideNav" class="pr-3">
            @include('admin.layouts.sideNav')
        </div>
        <div id="content" class="p-0">
            @yield('content')
        </div>
    </div>
</div>
<div style="display: hidden; visibility: hidden;">
    <script src="{{ asset('js/library/jquery.min.js') }}"></script>
    <script src="{{ asset('js/library/popper.min.js') }}"></script>
    <script src="{{ asset('js/library/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('js')
</div>
</body>
</html>

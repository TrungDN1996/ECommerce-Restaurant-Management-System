@extends('admin.layouts.master')

@section('content')
    <div class="row m-0" id="admin-homepage">
        <div class="col-12 p-0 text-center">
            <h1>Admin Dashboard</h1>
            <p>You are loggin in as Admin</p>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/admin/homepage.css') }}">
@endsection
@section('js')
    <script src="{{ asset('/js/admin/homepage.js') }}"></script>
@endsection

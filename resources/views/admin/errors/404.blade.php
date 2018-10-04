@extends('admin.layouts.master')

@section('content')
    <div class="text-center" style="margin-top: 30vh;">
        <h1>OOpppss .... !</h1>
        <h1>404 ERROR</h1>
        <h3>Your page you are looking for not found</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    </div>
@endsection

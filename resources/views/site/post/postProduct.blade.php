@extends('site.layouts.master')

@section('content')
    <div class="row m-0" id="post-title-background" style="background-image: url('{{ asset('/media/background/bg-post.jpg') }}')">
        <div class="col-12">
            <div class="row" id="post-title-wrap">
                <div class="col-auto text-center">
                    <h1 id="post-title">{{ $post->title }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-0" id="post-main">
        <div class="col-12 col-sm-9 p-0">
            @if ($post->type == 'post_product')
                @include('site.post.product')
            @endif
            <div class="row m-0" id="post-content">
                {!! $post->content !!}
            </div>
        </div>
        <div class="col-12 col-sm-3 p-0" id="post-sidebar">
            @if ($post->type == 'post_product')
                @include('site.sidebar.product')
            @else
                @include('site.sidebar.post')
            @endif
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/site/post.css') }}">
@endsection
@section('js')
    <script src="{{ asset('/js/site/post.js') }}"></script>
@endsection

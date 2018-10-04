<div id="closeAddMediaContainer" >
    {{-- <a href="javascript:void(0)" class="text-danger" id="closeAdminmediaShowItem"><i class="fas fa-times" style="font-size: 1.5em"></i></a> --}}
    <a href="javascript:void(0)" class="btn btn-secondary">Close</a>
</div>

@include('admin.post.create.media.header')

@include('admin.post.create.media.selectBox')

<div class="row">
    <div class="col-12 col-md-9 bg-white p-3" id="adminMediaListAllFiles">
        @include('admin.post.create.media.content')
    </div>
    <div class="col-12 col-md-3" id="mediaInfoSideBar">
        @include('admin.post.create.media.sidebar')
    </div>
    <div class="col-12 row" id="addMediaFooter">
        <button class="btn btn-primary ml-auto">Inseart</button>
    </div>
</div>

@extends('admin.layouts.master')

@section('content')
    <div class="row m-0 p-3">
        <div class="col-auto">
            <h2>User Info</h2>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.user') }}" class="btn btn-info" role="button">All Users</a>
        </div>
        <div class="col-auto ml-auto">
            <a href="{{ route('admin.user.order', $user->id) }}" class="btn btn-info" role="button">Order Detail</a>
            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-info" role="button">Edit</a>
        </div>
    </div>
    @include('elements.alert.alertNoErrors')
    @if ($user->deleted_at !== null)
        <div class="alert alert-danger text-center">
            Alert: This user has been soft deleted !
        </div>
    @endif
    <div class="row m-0 flex-column justify-content-center text-center">
        <div class="col-auto p-3">
            <div id="user-avatar-wrap" class="mx-auto">
                <img src="{{ asset($user->avatar) }}" alt="No Image Found" class="img-fluid">
            </div>
        </div>
        <div class="col-auto">
            <form action="{{ route('admin.user.updateAvatar', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="UploadUserAvatar" class="btn btn-info" role="button">Change Avatar</label>
                    <span class="file-name"></span>
                    <input type="file" name="avatar" id="UploadUserAvatar">
                </div>
                <input type="submit" value="Save" class="btn btn-info">
            </form>
        </div>
    </div>
    <div class="row m-0">
        <div class="col-auto mx-auto" id="show-info-user-table-wrap">
            <table class="table table-hove">
                <thead>
                    <tr>
                        <th scope="col" colspan="2" class="text-center">User Info</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">ID:</th>
                        <td>{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Name:</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Username:</th>
                        <td>{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Email:</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Phone:</th>
                        <td>{{ $user->phone }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Address:</th>
                        <td>{{ $user->address }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Status</th>
                        <td>{{ $user->status }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Type:</th>
                        <td>{{ $user->type }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Role:</th>
                        <td>{{ $user->role }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Active:</th>
                        <td class="row">
                            @if ($user->deleted == null)
                                @if ($user->activate !== 0)
                                    <strong class="text-info mr-3">Activated</strong>
                                    <form action="{{ route('admin.user.deActivate', $user->id) }}" method="post" class="col-auto">
                                        @csrf
                                        <input type="submit" value="Deactive User" class="btn btn-primary">
                                    </form>
                                @else
                                    <strong class="text-danger">InActivate</strong>
                                    <form action="{{ route('admin.user.activate', $user->id) }}" method="post" class="col-auto">
                                        @csrf
                                        <input type="submit" value="Active Now" class="btn btn-primary">
                                    </form>
                                @endif
                            @else
                                <strong><span class="text-warning">Deleted</span></strong>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Change Password:</th>
                        <td><a href="{{ route('admin.user.showPasswordResetForm', $user->id) }}" role="button" class="btn btn-warning">Change password</a></td>
                    </tr>
                    <tr>
                        <th scope="row">Order Detail:</th>
                        <td><a href="{{ route('admin.user.order', $user->id) }}" class="btn btn-info" rol="button">Order Detail</a></td>
                    </tr>
                    @if ($user->deleted_at !== null)
                        <tr>
                            <th scope="row" class="text-danger">Restore:</th>
                            <td> <a href="{{ route('admin.user.restore', $user->id) }}" class="btn btn-info" role="button">Restore</a></td>
                        </tr>
                    @endif
                    <tr>
                        <th scope="row">Edit:</th>
                        <td><a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-info" rol="button">Edit</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
	<script src="{{ asset("js/admin/user.js") }}"></script>
@endsection

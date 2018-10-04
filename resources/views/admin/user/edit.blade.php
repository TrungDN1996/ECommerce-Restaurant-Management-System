@extends('admin.layouts.master')

@section('content')
    <div class="row m-0 p-3">
        <div class="col-auto">
            <h2>Edit User Info</h2>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.user.create') }}" class="btn btn-info" role="button">Create New</a>
        </div>
    </div>
    @include ('elements.alert.alertNoErrors')
    @if ($user->deleted_at !== null)
        <div class="alert alert-danger text-center">
            Alert: This user has been soft deleted !
        </div>
    @endif
    @if (session()->has("data"))
        @php
            $data = session()->get("data");
        @endphp
    @endif
    <div class="row m-0">
        <div class="col-auto mx-auto" id="show-info-user-table-wrap">
            <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                @csrf
                @method('put')
                <table class="table table-hove">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2" class="text-center">Edit User Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">ID</th>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="name">Name:</label></th>
                            <td>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required value="{{ isset($data['name']) ? $data['name'] : $user->name }}">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="username">Username:</label></th>
                            <td>
                                <input type="text" name="username" id="username" value="{{ isset($data['username']) ? $data['username'] : $user->username }}" class="form-control{{ $errors->has('username') ? ' is-invalide' : '' }}">
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="email">Email:</label></th>
                            <td>
                                <input type="email" name="email" id="email" value="{{ isset($data['email']) ? $data['email'] : $user->email }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="phone">Phone:</label></th>
                            <td>
                                <input type="text" name="phone" id="phone" value="{{ isset($data['phone']) ? $data['phone'] : $user->phone }}" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}">
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="address">Address:</label></th>
                            <td>
                                <input type="text" name="address" id="address" value="{{ isset($data['address']) ? $data['address'] : $user->address }}" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}">
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="status">Status:</label></th>
                            <td>
                                <select name="status" id="status" class="custom-select">
                                    @foreach ($statuses as $key => $status)
                                        @if (isset($data["status"]))
                                            @if ($status == $data["status"])
                                                <option value="{{ $status }}" selected>{{ $status }}</option>
                                            @else
                                                <option value="{{ $status }}">{{ $status }}</option>
                                            @endif
                                        @else
                                            @if ($status == $user->status)
                                                <option value="{{ $user->status }}" selected>{{ $user->status }}</option>
                                            @else
                                                <option value="{{ $status }}">{{ $status }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="type">Type:</label></th>
                            <td>
                                <select name="type" id="" class="custom-select">
                                @foreach ($types as $key => $type)
                                    @if (isset($data["type"]))
                                        @if ($type == $data["type"])
                                            <option value="{{ $type }}" selected>{{ $type }}</option>
                                        @else
                                            <option value="{{ $type }}">{{ $type }}</option>
                                        @endif
                                    @else
                                        @if ($type == $user->type)
                                            <option value="{{ $user->type }}" selected>{{ $user->type }}</option>
                                        @else
                                            <option value="{{ $type }}">{{ $type }}</option>
                                        @endif
                                    @endif
                                @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="role">Role:</label></th>
                            <td>
                                <select name="role" id="role" class="custom-select">
                                @foreach ($roles as $key => $role)
                                    @if (isset($data["role"]))
                                        @if ($role == $data["role"])
                                            <option value="{{ $role }}" selected>{{ $role }}</option>
                                        @else
                                            <option value="{{ $role }}">{{ $role }}</option>
                                        @endif
                                    @else
                                        @if ($role == $user->role)
                                            <option value="{{ $user->role }}" selected>{{ $user->role }}</option>
                                        @else
                                            <option value="{{ $role }}">{{ $role }}</option>
                                        @endif
                                    @endif
                                @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="active">Activate/InActivate:</label></th>
                            <td class="row">
                                @if ($user->delete == null)
                                    <select name="activate" id="active" class="col-auto mr-3">
                                        @if (isset($data["activate"]))
                                            @if ($data["activate"] == 0)
                                                <option value="0" selected><span class="text-danger">Inactive</span></option>
                                                <option value="1">Active</option>
                                            @else
                                                <option value="1" selected><span class="text-info">Activated</span></option>
                                                <option value="0">Inactive</option>
                                            @endif
                                        @else
                                            @if ($user->activate == 0)
                                                <option value="0" selected><span class="text-danger">Inactive</span></option>
                                                <option value="1">Active</option>
                                            @else
                                                <option value="1" selected><span class="text-info">Activated</span></option>
                                                <option value="0">Inactive</option>
                                            @endif
                                        @endif
                                    </select>
                                @else
                                    <strong><span class="text-warning">Deleted</span></strong>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                <a href="{{ route('admin.user.show', $user->id) }}" role="button" class="btn btn-danger mr-3" onclick="return confirm('Are you sure?')">Cancel</a>
                                <input type="submit" value="Update" class="btn btn-primary">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
@endsection

@section('js')
	<script src="{{ asset("js/admin/user.js") }}"></script>
@endsection

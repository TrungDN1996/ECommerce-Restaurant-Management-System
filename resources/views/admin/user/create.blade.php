@extends('admin.layouts.master')

@section('content')
    <div class="row m-0 p-3">
        <div class="col-auto">
            <h2>Create New User</h2>
        </div>
    </div>
    @include('elements.alert.alertNoErrors')
    <div class="row m-0">
        @php
            if (isset($data)) {
                print_r($data);
            }
        @endphp
        @if (session()->has("data"))
            @php
                $data = session()->get("data");
            @endphp
        @endif
    </div>
    <div class="row m-0">
        <div class="col-auto mx-auto" id="show-info-user-table-wrap">
            <form action="{{ route('admin.user.store') }}" method="POST">
                @csrf
                <table class="table table-hove">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2" class="text-center">Edit User Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"><label for="name">Name:</label></th>
                            <td>
                                <input id="name" type="text" required placeholder="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ isset($data['name']) ? $data['name'] : '' }}">
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
                                <input type="text" name="username" id="username" required placeholder="username" class="form-control{{ $errors->has('username') ? ' is-invalide' : '' }}" value="{{ isset($data['username']) ? $data['username'] : '' }}">
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
                                <input type="email" name="email" id="email" required placeholder="example@example.com" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ isset($data['email']) ? $data['email'] : '' }}">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="password">Password:</label></th>
                            <td>
                                <input type="password" name="password" id="password" required class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="password_confirmation">Confirm Password:</label></th>
                            <td>
                                <input type="password" name="password_confirmation" id="password_confirmation" required class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}">
                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="role">Role:</label></th>
                            <td>
                                <select name="role" id="role" class="custom-select">
                                    @if (isset($data["role"]))
                                        @if ($data["role"] == "user")
                                            <option value="user" selected>user</option>
                                            <option value="admin">admin</option>
                                        @else
                                            <option value="user">user</option>
                                            <option value="admin" selected>admin</option>
                                        @endif
                                    @else
                                        <option value="user">user</option>
                                        <option value="admin">admin</option>
                                    @endif
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                <a href="{{ route('admin.user') }}" role="button" class="btn btn-danger mr-3" onclick="return confirm('Are you sure?')">Cancel</a>
                                <input type="submit" value="Add New" class="btn btn-primary">
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

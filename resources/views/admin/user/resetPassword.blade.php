@extends('admin.layouts.master')

@section('content')
    <div class="row m-0 py-3">
        <div class="col-auto">
            <h1>Reset Password User ID: {{ $user->id }}</h1>
        </div>
    </div>
    @include('elements.alert.alertNoErrors')
    <div class="row m-0 py-3 justify-content-center">
        <div class="col-auto w-500">
            <form action="{{ route('admin.user.resetPassword', $user->id) }}" method="POST">
                @csrf
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2" class="text-center"><span class="text-info">Change password</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"><label for="password">New Password:</label></th>
                            <td><input type="password" name="password" id="password"class="form-control"></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="password_confirmation">Confirm password:</label></th>
                            <td><input type="password" name="password_confirmation" id="password_confirmation" class="form-control"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                <a href="{{ route('admin.user.show', $user->id) }}" class="btn btn-warning" role="button" onclick="return confirm('Are You Sure?')">Cancel</a>
                                <input type="submit" value="Submit" class="btn btn-info">
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

@extends('admin.layouts.master')

@section('content')
	@php
		if (session()->has("search"))
			$search = session()->get("search");
	@endphp
	<div class="row m-0 p-3 flex-column flex-md-row text-center">
		<div class="col-auto pb-3">
			<h2>User</h2>
		</div>
		<div class="col-auto pb-3">
			<a href="{{ route('admin.user.create') }}" class="btn btn-info" role="button" id="create-user-botton">Add New</a>
		</div>
		<div class="col-12 col-md-auto ml-md-auto">
			<form action="{{ route('admin.user.search') }}" method="get" class="row justify-content-center justify-content-md-end">
				@csrf
				<div class="form-group">
					<label for="searchUserValue" class="d-none">Search User</label>
					{{-- <input type="search" name="search" class="form-control" id="searchUserValue" value="{{ session()->has('search') ? session()->get('search') : '' }}"> --}}
					<input type="search" name="search" class="form-control" id="searchUserValue" value="{{ isset($search) ? $search : '' }}">
				</div>
				<div class="col-auto">
					<input type="submit" value="Search" class="btn btn-info">
				</div>
			</form>
		</div>
	</div>

	@include('elements.alert')

	@include('admin.user.selectBox')
	@include('admin.user.bulkAction')

	<div class="row m-0 px-50" id="adminUserTableList">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col"><input type="checkbox" name="checkall" class="checkbox-all"></th>
						<th scope="col">ID</th>
						<th scope="col">Name</th>
						<th scope="col">Username</th>
						<th scope="col">Email</th>
						<th scope="col">Activate</th>
						<th scope="col">Role</th>
						<th scope="col">User Info</th>
						<th scope="col">Order Detail</th>
						<th scope="col">Edit</th>
						<th scope="col">Delete</th>
					</tr>
				</thead>
				<tbody>
				@foreach ($users as $user)
					<tr>
						<td><input type="checkbox" name="user_{{ $user->id }}" class="checkbox-item" value="{{ $user->id }}" form="adminUserBulkActionForm"></td>
						<td>{{ $user->id }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->username }}</td>
						<td>{{ $user->email }}</td>
						<td>
							@if ($user->activate == 0)
								<label for="activate_{{ $user->id }}" class="toggle-switch">
									<input type="checkbox" name="activate" user-id="{{ $user->id }}" url="{{ route('admin.user.activateAjax', $user->id) }}" id="activate_{{ $user->id }}" class="d-none activate-checkbox switch-checkbox">
									<span class="switch-slider"></span>
								</label>
							@else
								<label for="activate_{{ $user->id }}" class="toggle-switch">
									<input type="checkbox" name="activate" user-id="{{ $user->id }}" url="{{ route('admin.user.activateAjax', $user->id) }}" checked id="activate_{{ $user->id }}" class="d-none activate-checkbox switch-checkbox">
									<span class="switch-slider"></span>
								</label>
							@endif
						</td>
						<td>{{ $user->role }}</td>
						<td class="text-center"><a href="{{ route('admin.user.show', $user->id) }}" class="text-dark"><i class="fas fa-user-circle fs-2rem"></i></a></td>
						<td class="text-center"><a href="#" style="color: #c58d5b;"><i class="fas fa-shopping-cart fs-2rem text-center"></i></a></td>
						<td><a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-info">Edit</a></td>
						<td>
							<form action="{{ route('admin.user.destroy', $user->id) }}" method="post" onsubmit="return confirm('Confirm Delete User')">
								@csrf
								@method('delete')
								<input type="submit" value="Delete" role="button" class="btn btn-danger">
							</form>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			<div class="paginate-container col-12 p-0">{{ $users->links() }}</div>
		</div>
		<script type="text/javascript">
			var url = "{{ route('admin.user.filter') }}";
			var FilterMonthUrl = "{{ route('admin.user.filter.month') }}";
			var FilterDayUrl = "{{ route('admin.user.filter.day') }}";
		</script>
@endsection

@section('js')
	<script src="{{ asset("js/admin/user.js") }}"></script>
@endsection

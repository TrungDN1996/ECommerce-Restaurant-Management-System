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
            <th scope="col" colspan="2" class="text-center">Action</th>
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
                @if ($user->deleted_at !== null)
                    <strong class="text-warning">Deleted</strong>
                @else
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
                @endif
            </td>
            <td>{{ $user->role }}</td>
            @if ($user->deleted_at == null)
                <td><a href="{{ route('admin.user.show', $user->id) }}"><i class="fas fa-user-circle fs-2rem text-center"></i></a></td>
                <td><a href="#" style="color: #c58d5b;"><i class="fas fa-shopping-cart fs-2rem text-center"></i></a></td>
                <td class="text-center"><a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-info">Edit</a></td>
                <td>
                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="post" onsubmit="return confirm('Confirm Delete User')" class="text-center">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Delete" role="button" class="btn btn-danger">
                    </form>
                </td>
            @else
                <td class="text-center"><a href="{{ route('admin.user.show', $user->id) }}" class="text-dark"><i class="fas fa-user-circle fs-2rem text-center"></i></a></td>
                <td class="text-center"><strong class="text-danger">Not Allow</strong></td>
                <td>
                    <form action="{{ route('admin.user.restore', $user->id) }}" method="post" class="text-center">
                        @csrf
                        <input type="submit" value="Restore" role="button" class="btn btn-primary">
                    </form>
                </td>
                <td>
                    <form action="{{ route('admin.user.forceDestroy', $user->id) }}" method="post" class="text-center" onsubmit="return confirm('Confirm Permanently Delete User')">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Force Delete" role="button" class="btn btn-danger">
                    </form>
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
<div class="paginate-ajax col-12 p-0">
    {{ $users->appends([
                'select' => $select,
                'role' => $role,
                'activate' => $activate,
                'status' => $status,
                'type' => $type,
                'year' => $year,
                'month' => $month,
                'day' => $day,
           ])->links() }}
</div>

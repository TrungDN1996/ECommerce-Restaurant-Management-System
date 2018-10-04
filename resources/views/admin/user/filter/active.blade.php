<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col"><input type="checkbox" name="checkall" class="checkbox-all"></th>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Activated</th>
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
            <td class="text-center"><a href="{{ route('admin.user.show', $user->id) }}" class="text-dark"><i class="fas fa-user-circle fs-2rem text-center"></i></a></td>
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

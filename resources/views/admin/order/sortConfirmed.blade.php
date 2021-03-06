@if(count($confirmed) == 0)
    No Record Found
@else
    @foreach ($confirmed as $record)
    <tr>
        <td scope="row">{{ $record->id }}</td>
        <td>{{ $record->user->name }}</td>
        <td>{{ $record->total }}$</td>
        <td>{{ $record->type }}</td>
        <td>{{ $record->status }}</td>
        <td>{{ date_format($record->created_at, 'h:m d/m/y') }}</td>
        <td><a href="{{ route('admin.order.show', $record->id) }}" style="text-decoration: none;">Detail</a></td>
        <td>
            <form action="{{ route('admin.order.destroy', $record->id) }}" method="post" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('delete')
                <input type="hidden" name="destroy" value="1">
                <input type="submit" value="Delete" role="button" class="btn btn-danger">
            </form>
        </td>
    </tr>
    @endforeach
@endif
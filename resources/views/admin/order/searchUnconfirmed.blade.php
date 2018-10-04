@if(count($searchs) == 0)
    No Record Found
@else
   @foreach ($searchs as $search)
    <tr>
        <td scope="row">{{ $search->id }}</td>
        <td>{{ $search->user->name }}</td>
        <td>{{ $search->total }}$</td>
        <td>{{ $search->type }}</td>
        <td>{{ $search->status }}</td>
        <td>{{ date_format($search->created_at, 'h:m d/m/y') }}</td>
        <td><a href="{{ route('admin.order.show', $search->id) }}" style="text-decoration: none;">Detail</a></td>
        <td>
            <a href="{{ route('admin.order.confirm', $search->id) }}"><button type="button" class="btn btn-primary">Confirm</button></a>
        </td>
        <td>
            <form action="{{ route('admin.order.destroy', $search->id) }}" method="post" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('delete')
                <input type="hidden" name="destroy" value="0">
                <input type="submit" value="Delete" role="button" class="btn btn-danger">
            </form>
        </td>
    </tr>
    @endforeach
@endif


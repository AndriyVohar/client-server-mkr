<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Medicines</title>
</head>
<body>
    <h1>Medicines</h1>

    @if(session('success'))
        <div style="color:green">{{ session('success') }}</div>
    @endif

    <p><a href="{{ route('medicines.create') }}">Create new medicine</a></p>

    @if($medicines->count())
        <table border="1" cellpadding="6" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Manufacturer</th>
                    <th>Expiration date</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medicines as $m)
                <tr>
                    <td>{{ $m->id }}</td>
                    <td>{{ $m->name }}</td>
                    <td>{{ $m->manufacturer }}</td>
                    <td>{{ $m->expiration_date->format('Y-m-d') }}</td>
                    <td>{{ number_format($m->price, 2) }}</td>
                    <td>
                        <a href="{{ route('medicines.show', $m) }}">View</a> |
                        <a href="{{ route('medicines.edit', $m) }}">Edit</a> |
                        <form action="{{ route('medicines.destroy', $m) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this item?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top:1em">{{ $medicines->links() }}</div>
    @else
        <p>No medicines yet.</p>
    @endif

    <p><a href="/">Back to home</a></p>
</body>
</html>


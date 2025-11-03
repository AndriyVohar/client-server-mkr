<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Medicines</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>
    <style>
        /* concrete colors to avoid analyzer warnings */
        body {
            font-family: Instrument Sans, system-ui, -apple-system, "Segoe UI", Roboto, 'Noto Sans', sans-serif;
            background: #fdfdfc;
            color: #1b1b18;
            padding: 24px
        }

        .container {
            max-width: 980px;
            margin: 0 auto
        }

        .card {
            background: #fff;
            padding: 18px;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .06);
            border: 1px solid #e3e3e0
        }

        h1 {
            margin: 0 0 10px
        }

        .muted {
            color: #706f6c
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px
        }

        th, td {
            padding: 10px;
            border: 1px solid #e3e3e0;
            text-align: left
        }

        th {
            background: #fafafa
        }

        .actions a, .actions form {
            display: inline-block;
            margin-right: 6px
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 6px;
            background: #1b1b18;
            color: #fff;
            text-decoration: none
        }

        .btn-ghost {
            background: transparent;
            border: 1px solid #e3e3e0;
            color: #1b1b18
        }

        form.inline {
            display: inline
        }

        .pager {
            margin-top: 12px
        }

        a.logo {
            color: #1b1b18;
            text-decoration: none;
            font-weight: 600
        }
    </style>
</head>
<body>
<div class="container">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
        <a href="/" class="logo">&larr; Home</a>
        <a href="{{ route('medicines.create') }}" class="btn">Create medicine</a>
    </div>

    <div class="card">
        <h1>Medicines</h1>

        @if(session('success'))
            <div style="color:green;margin-bottom:8px">{{ session('success') }}</div>
        @endif

        @if($medicines->count())
            <table>
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
                        <td class="actions">
                            <a href="{{ route('medicines.show', $m) }}" class="btn-ghost">View</a>
                            <a href="{{ route('medicines.edit', $m) }}" class="btn-ghost">Edit</a>
                            <form action="{{ route('medicines.destroy', $m) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Delete this item?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-ghost">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="pager">{{ $medicines->links() }}</div>
        @else
            <p class="muted">No medicines yet.</p>
        @endif
    </div>
</div>
</body>
</html>

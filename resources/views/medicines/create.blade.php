<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Create medicine</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>
    <style>
        :root {
            --bg: #fdfdfc;
            --card: #fff;
            --muted: #706f6c;
            --accent: #1b1b18;
            --border: #e3e3e0
        }

        body {
            font-family: Instrument Sans, system-ui, -apple-system, "Segoe UI", Roboto, 'Noto Sans', sans-serif;
            background: var(--bg);
            color: var(--accent);
            padding: 24px
        }

        .container {
            max-width: 700px;
            margin: 0 auto
        }

        .card {
            background: var(--card);
            padding: 18px;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .06);
            border: 1px solid var(--border)
        }

        label {
            display: block;
            margin-bottom: 8px
        }

        input[type=text], input[type=date], input[type=number] {
            width: 100%;
            padding: 8px;
            border: 1px solid var(--border);
            border-radius: 6px
        }

        .row {
            display: flex;
            gap: 12px
        }

        .col {
            flex: 1
        }

        .actions {
            margin-top: 12px
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 6px;
            background: var(--accent);
            color: #fff;
            text-decoration: none
        }

        .btn-ghost {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--accent)
        }

        a.logo {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600
        }
    </style>
</head>
<body>
<div class="container">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
        <a href="{{ route('medicines.index') }}" class="logo">&larr; Back to list</a>
        <a href="/" class="btn-ghost">Home</a>
    </div>

    <div class="card">
        <h1>Create medicine</h1>

        @if($errors->any())
            <div style="color:red;margin-bottom:8px">
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('medicines.store') }}" method="POST">
            @csrf
            <div style="margin-bottom:10px">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
            </div>

            <div style="margin-bottom:10px">
                <label>Manufacturer</label>
                <input type="text" name="manufacturer" value="{{ old('manufacturer') }}" required>
            </div>

            <div class="row" style="margin-bottom:10px">
                <div class="col">
                    <label>Expiration date</label>
                    <input type="date" name="expiration_date" value="{{ old('expiration_date') }}" required>
                </div>
                <div class="col">
                    <label>Price</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price') }}" required>
                </div>
            </div>

            <div class="actions">
                <button class="btn" type="submit">Save</button>
                <a href="{{ route('medicines.index') }}" class="btn-ghost">Cancel</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>

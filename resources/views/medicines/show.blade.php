<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>View medicine</title>
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

        ul {
            list-style: none;
            padding: 0
        }

        li {
            padding: 8px 0;
            border-bottom: 1px solid var(--border)
        }

        .label {
            font-weight: 600;
            color: var(--muted);
            display: inline-block;
            width: 160px
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
        <h1>Medicine #{{ $medicine->id }}</h1>

        <ul>
            <li><span class="label">Name:</span> {{ $medicine->name }}</li>
            <li><span class="label">Manufacturer:</span> {{ $medicine->manufacturer }}</li>
            <li><span class="label">Expiration date:</span> {{ $medicine->expiration_date->format('Y-m-d') }}</li>
            <li><span class="label">Price:</span> {{ number_format($medicine->price, 2) }}</li>
        </ul>

        <div class="actions">
            <a href="{{ route('medicines.edit', $medicine) }}" class="btn">Edit</a>
            <a href="{{ route('medicines.index') }}" class="btn-ghost">Back to list</a>
        </div>
    </div>
</div>
</body>
</html>

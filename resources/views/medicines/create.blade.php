<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Create medicine</title>
</head>
<body>
    <h1>Create medicine</h1>

    @if($errors->any())
        <div style="color:red">
            <ul>
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('medicines.store') }}" method="POST">
        @csrf
        <div>
            <label>Name:<br>
            <input type="text" name="name" value="{{ old('name') }}"></label>
        </div>
        <div>
            <label>Manufacturer:<br>
            <input type="text" name="manufacturer" value="{{ old('manufacturer') }}"></label>
        </div>
        <div>
            <label>Expiration date:<br>
            <input type="date" name="expiration_date" value="{{ old('expiration_date') }}"></label>
        </div>
        <div>
            <label>Price:<br>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}"></label>
        </div>
        <div style="margin-top:1em">
            <button type="submit">Save</button>
            <a href="{{ route('medicines.index') }}">Cancel</a>
        </div>
    </form>
</body>
</html>


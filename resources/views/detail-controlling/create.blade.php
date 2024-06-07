<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('detailcontrolling.store') }}" method="POST">
        @csrf
        <select name="id_controlling">
            @foreach ($controlling as $control)
                <option value="{{ $control->id }}">{{ $control->devices->name    }}</option>
            @endforeach
        </select>
        <input type="number" name="temperature" placeholder="Temperature">
        <input type="number" name="watt" placeholder="Temperature">
    <button type="submit">Simpan</button>
    </form>
</body>
</html>

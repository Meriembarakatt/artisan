<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="{{route('familles.store')}}">
    @csrf
        <label for="">famille</label>
        <input type="text" name="famille" >
        <button type="submit">Ajouter la famille</button>
    </form>
</body>
</html>
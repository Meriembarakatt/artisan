<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une famille</title>
</head>
<body>
    <h1>Ajouter une famille</h1>
    <form method="POST" action="{{ route('familles.store') }}">
        @csrf
        <label for="famille">Nom de la famille :</label>
        <input type="text" id="famille" name="famille" required>
        <button type="submit">Ajouter la famille</button>
    </form>
</body>
</html>

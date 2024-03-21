<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'ajout d'artisan</title>
</head>
<body>
    <form method="POST" action="{{ route('artisan.store') }}">
        @csrf
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom">
        <label for="prenom">Prénom</label>
        <input type="text" id="prenom" name="prenom">
        <label for="email">Email</label>
        <input type="email" id="email" name="email">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password">
        <label for="adresse">Adresse</label>
        <input type="text" id="adresse" name="adresse">
        <label for="ville">Ville</label>
        <input type="text" id="ville" name="ville">
        <label for="fonction">Fonction</label>
        <input type="text" id="fonction" name="fonction">
        <button type="submit">Ajouter l'artisan</button>
    </form>
</body>
</html>

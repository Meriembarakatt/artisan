<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="{{route('client.store')}}">
        @csrf
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" required>
        <label for="prenom">Prénom</label>
        <input type="text" id="prenom" name="prenom" required>
        <label for="tell">Téléphone</label>
        <input type="text" id="tell" name="tell" required>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        <label for="adress">Adresse</label>
        <input type="text" id="adress" name="adress" required>
        <label for="ville">Ville</label>
        <input type="text" id="ville" name="ville" required>
        <button type="submit">Ajouter</button>
</html>
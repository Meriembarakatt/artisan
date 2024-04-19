<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'ajout d'artisan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .text-danger {
            color: red;
        }
    </style>
</head>
<body>
    <form method="POST" action="{{ route('artisan.store') }}">
        @csrf
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom">
        @error('nom')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <label for="prenom">Prénom</label>
        <input type="text" id="prenom" name="prenom">
        @error('prenom')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <label for="email">Email</label>
        <input type="email" id="email" name="email">
        @error('email')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password">
        @error('password')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <label for="adresse">Adresse</label>
        <input type="text" id="adress" name="adress">
        @error('adress')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <label for="ville">Ville</label>
        <input type="text" id="ville" name="ville">
        @error('ville')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <label for="fonction">Fonction</label>
        <input type="text" id="fonction" name="fonction">
        @error('fonction')
        <div class="text-danger">{{ $message }}</div>
    @enderror
        <label for="tell">tell</label>
        <input type="text" id="tell" name="tell">
        @error('tell')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-success"class="btn btn-success float-right">Ajouter l'artisan</button>
        <a href="{{ route('artisan.index') }}" class="btn btn-success float-right">Annuler</a>
                      
    </form>
</body>
</html>

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier l'Artisan</h1>

        <form action="{{ route('artisan.update', $artisan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ $artisan->nom }}">
            </div>

            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $artisan->prenom }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $artisan->email }}">
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Entrez un nouveau mot de passe">
            </div>

            <div class="form-group">
                <label for="adress">Adresse</label>
                <input type="text" class="form-control" id="adress" name="adress" value="{{ $artisan->adress }}">
            </div>

            <div class="form-group">
                <label for="ville">Ville</label>
                <input type="text" class="form-control" id="ville" name="ville" value="{{ $artisan->ville }}">
            </div>

            <div class="form-group">
                <label for="tell">Téléphone</label>
                <input type="text" class="form-control" id="tell" name="tell" value="{{ $artisan->tell }}">
            </div>

            <div class="form-group">
                <label for="fonction">Fonction</label>
                <input type="text" class="form-control" id="fonction" name="fonction" value="{{ $artisan->fonction }}">
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>

        <a href="{{ route('artisan.index') }}" class="btn btn-secondary mt-3">Annuler</a>
    </div>
@endsection

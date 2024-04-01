@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Détails de l'Artisan</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">ID : {{ $artisan->id }}</h5>
                <p class="card-text">Nom : {{ $artisan->nom }}</p>
                <p class="card-text">Prénom : {{ $artisan->prenom }}</p>
                <p class="card-text">Email : {{ $artisan->email }}</p>
                <p class="card-text">Adresse : {{ $artisan->adress }}</p>
                <p class="card-text">Ville : {{ $artisan->ville }}</p>
                <p class="card-text">Téléphone : {{ $artisan->tell }}</p>
                <p class="card-text">Fonction : {{ $artisan->fonction }}</p>
            </div>
        </div>

        <a href="{{ route('artisan.index') }}" class="btn btn-secondary mt-3">Retour à la liste des Artisans</a>
    </div>
@endsection

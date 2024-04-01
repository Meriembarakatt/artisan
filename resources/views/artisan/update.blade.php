@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="alert alert-success">
            Les informations de l'artisan ont été mises à jour avec succès.
        </div>

        <a href="{{ route('artisan.index') }}" class="btn btn-primary">Retour à la liste des Artisans</a>
    </div>
@endsection

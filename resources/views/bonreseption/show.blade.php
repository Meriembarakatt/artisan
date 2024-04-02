@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Détails du Bon de Réception</div>

                    <div class="card-body">
                        <p><strong>ID:</strong> {{ $bonreception->id }}</p>
                        <p><strong>Date:</strong> {{ $bonreception->date }}</p>
                        <p><strong>Artisan:</strong> {{ $bonreception->artisan->nom }}</p>

                        <div class="mt-3">
                            <a href="{{ route('bonreseption.edit', $bonreception->id) }}" class="btn btn-primary">Modifier</a>
                            <form action="{{ route('bonreseption.destroy', $bonreception->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce bon de réception ?')">Supprimer</button>
                            </form>
                            <a href="{{ route('bonreseption.index') }}" class="btn btn-secondary">Retour à la liste</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

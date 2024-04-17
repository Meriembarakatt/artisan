@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2> Liste des artisans </h2>
                   <a href="{{ route('reglement_artisan.create') }}" class="btn btn-success">Ajouter un artisan</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Artisan</th>
                                <th>Mode de paiement</th>
                                <th>Date</th>
                                <th>Montant</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($regArtisans as $regArtisan)
                            <tr>
                                <td>{{ $regArtisan->id }}</td>
                                <td>{{ $regArtisan->artisan->nom }}</td>
                                <td>{{ $regArtisan->mode->mode }}</td>
                                <td>{{ $regArtisan->date }}</td>
                                <td>{{ $regArtisan->montant }}</td>
                                <td>
                                    <a href="{{ route('reglement_artisan.edit', $regArtisan->id) }}" class="btn btn-primary">Modifier</a>
                                    <form action="{{ route('reglement_artisan.destroy', $regArtisan->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                    <!-- Bouton pour ouvrir le modal -->
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalDetails{{ $regArtisan->id }}">
                                        Détails
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $regArtisans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour afficher les détails d'un paiement artisan -->
@foreach($regArtisans as $regArtisan)
<div class="modal fade" id="modalDetails{{ $regArtisan->id }}" tabindex="-1" aria-labelledby="modalDetails{{ $regArtisan->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetails{{ $regArtisan->id }}Label">Détails du paiement artisan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID :</strong> {{ $regArtisan->id }}</p>
                <p><strong>Artisan :</strong> {{ $regArtisan->artisan->nom }}</p>
                <p><strong>Mode de paiement :</strong> {{ $regArtisan->mode->mode }}</p>
                <p><strong>Date :</strong> {{ $regArtisan->date }}</p>
                <p><strong>Montant :</strong> {{ $regArtisan->montant }}</p>
                <!-- Ajoutez d'autres détails du paiement artisan ici -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

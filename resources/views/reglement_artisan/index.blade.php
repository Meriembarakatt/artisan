@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2> Liste des reglement artisan </h2>
                   <a href="{{ route('reglement_artisan.create') }}" class="btn btn-success">Ajouter</a>
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
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalmodifier{{ $regArtisan->id }}">
                                        modifier
                                    </button><form action="{{ route('reglement_artisan.destroy', $regArtisan->id) }}" method="POST" style="display: inline;">
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
 
{{-- 
modal   Modifier le Règlement Artisan --}}
@foreach($regArtisans as $regArtisan)
<div class="modal fade" id="modalmodifier{{ $regArtisan->id }}" tabindex="-1" aria-labelledby="modalDetails{{ $regArtisan->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetails{{ $regArtisan->id }}Label">modifier du paiement artisan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="card-body">
                    <form action="{{ route('reglement_artisan.update', $regArtisan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="artisan_id">Artisan:</label>
                            <select name="artisan_id" id="artisan_id" class="form-control">
                                @foreach($artisans as $artisan)
                                    <option value="{{ $artisan->id }}" {{ $regArtisan->artisan_id == $artisan->id ? 'selected' : '' }}>
                                        {{ $artisan->nom }} {{ $artisan->prenom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mode_id">Mode:</label>
                            <select name="mode_id" id="mode_id" class="form-control">
                                @foreach($modes as $mode)
                                    <option value="{{ $mode->id }}" {{ $regArtisan->mode_id == $mode->id ? 'selected' : '' }}>
                                        {{ $mode->mode }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ $regArtisan->date }}">
                        </div>
                        <div class="form-group">
                            <label for="montant">Montant:</label>
                            <input type="number" name="montant" id="montant" class="form-control" min="0" step="0.01" value="{{ $regArtisan->montant }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                        <a href="{{ route('reglement_artisan.index') }}" class="btn btn-secondary">Retour</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

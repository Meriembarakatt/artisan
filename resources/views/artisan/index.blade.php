@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2> Liste des artisans </h2>
                   <a href="{{ route('artisan.create') }}" class="btn btn-success">Ajouter un artisan</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($artisans as $artisan)
                            <tr>
                                <td>{{ $artisan->id }}</td>
                                <td>{{ $artisan->nom }}</td>
                                <td>{{ $artisan->prenom }}</td>
                                <td>{{ $artisan->email }}</td>
                                <td>
                                    <a href="{{ route('artisan.edit', $artisan->id) }}" class="btn btn-primary">Modifier</a>
                                    <form action="{{ route('artisan.destroy', $artisan->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet artisan ?')">Supprimer</button>
                                    </form>
                                    <!-- Bouton pour ouvrir le modal -->
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalArtisan{{ $artisan->id }}">
                                        Détails
                                    </button>
                                    <!-- Bouton pour ouvrir le modal des règlements -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalReglements{{ $artisan->id }}">
                                        Règlements
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $artisans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour afficher les détails de chaque artisan -->
@foreach($artisans as $artisan)
<div class="modal fade" id="modalArtisan{{ $artisan->id }}" tabindex="-1" aria-labelledby="modalArtisan{{ $artisan->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalArtisan{{ $artisan->id }}Label">Détails de l'artisan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID :</strong> {{ $artisan->id }}</p>
                <p><strong>Nom :</strong> {{ $artisan->nom }}</p>
                <p><strong>Prénom :</strong> {{ $artisan->prenom }}</p>
                <p><strong>Email :</strong> {{ $artisan->email }}</p>
                <!-- Ajoutez d'autres détails de l'artisan si nécessaire -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal pour afficher les règlements de chaque artisan -->
@foreach($artisans as $artisan)
<div class="modal fade" id="modalReglements{{ $artisan->id }}" tabindex="-1" aria-labelledby="modalReglements{{ $artisan->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalReglements{{ $artisan->id }}Label">Règlements de {{ $artisan->nom }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">  
                    <tbody>
                    @if($artisan->reglements)
                @foreach($artisan->reglements as $reglement)
                    <tr>
                        <td>{{ $reglement->id }}</td>
                        <td>{{ $reglement->date }}</td>
                        <td>{{ $reglement->montant }}</td>
                        <!-- Ajoutez d'autres données du règlement si nécessaire -->
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">Aucun règlement trouvé pour cet artisan.</td>
                </tr>
            @endif
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

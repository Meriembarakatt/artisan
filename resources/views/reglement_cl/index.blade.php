@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2> Liste des Règlements Clients</h2>
                    <a href="{{ route('reglement_cl.create') }}" class="btn btn-success">Ajouter un Règlement</a>
                   </div>

                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                   

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client</th>
                                <th>Mode</th>
                                <th>Date</th>
                                <th>Montant</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reglements as $reglement)
                            <tr>
                                <td>{{ $reglement->id }}</td>
                                <td>{{ $reglement->client->nom }}</td>
                                <td>{{ $reglement->mode->mode }}</td>
                                <td>{{ $reglement->date }}</td>
                                <td>{{ $reglement->montant }}</td>
                                <td>
                                    <a href="{{ route('reglement_cl.edit', $reglement->id) }}" class="btn btn-success btn-sm">Éditer</a>
                                    <form action="{{ route('reglement_cl.destroy', $reglement->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce règlement client ?')">Supprimer</button>
                                    </form>
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetailsReglement{{ $reglement->id }}">
                                        Détails
                                    </button>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="modalDetailsReglement{{ $reglement->id }}" tabindex="-1" aria-labelledby="modalDetailsReglementLabel{{ $reglement->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalDetailsReglementLabel{{ $reglement->id }}">Détails du règlement client</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>ID :</strong> {{ $reglement->id }}</p>
                                            <p><strong>Client :</strong> {{ $reglement->client->nom }}</p>
                                            <p><strong>Mode de règlement :</strong> {{ $reglement->mode->mode }}</p>
                                            <p><strong>Date :</strong> {{ $reglement->date }}</p>
                                            <p><strong>Montant :</strong> {{ $reglement->montant }}</p>
                                            <!-- Ajoutez d'autres détails du règlement ici -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $reglements->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

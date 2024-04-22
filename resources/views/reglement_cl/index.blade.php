@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2> Liste des Règlements Clients</h2>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAddReglement">
                        Ajouter un règlement
                    </button>
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
                                   
    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalModifierReglement{{ $reglement->id }}">
        Modifier
    </button>

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
{{-- modal Modifier un règlement de client --}}
@foreach($reglements as $reglement)
<div class="modal fade" id="modalModifierReglement{{ $reglement->id }}" tabindex="-1" aria-labelledby="modalModifierReglementLabel{{ $reglement->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalModifierReglementLabel{{ $reglement->id }}">Modifier le règlement client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('reglement_cl.update', $reglement->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="client_id">Client :</label>
                        <select name="client_id" id="client_id" class="form-control">
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" {{ $client->id == $reglement->client_id ? 'selected' : '' }}>{{ $client->prenom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mode_id">Mode de règlement :</label>
                        <select name="mode_id" id="mode_id" class="form-control">
                            @foreach ($modes as $mode)
                                <option value="{{ $mode->id }}" {{ $mode->id == $reglement->mode_id ? 'selected' : '' }}>{{ $mode->mode }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="montant">Montant :</label>
                        <input type="text" name="montant" id="montant" class="form-control" value="{{ $reglement->montant }}" required>
                    </div>

                    <div class="form-group">
                        <label for="date">Date :</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ $reglement->date }}" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- modal pour aajouter  --}}<!-- Modal -->
<div class="modal fade" id="modalAddReglement" tabindex="-1" aria-labelledby="modalAddReglementLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalAddReglementLabel">Ajouter un règlement pour le client</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('reglement_cl.store') }}">
                                        @csrf

                                        <div class="form-group">
                                            <label for="client_id">Client</label>
                                            <select id="client_id" name="client_id" class="form-control" >
                                                <option value="">Sélectionnez un client</option>
                                                @foreach($clients as $client)
                                                    <option value="{{ $client->id }}">{{ $client->nom }} {{ $client->prenom }}</option>
                                                @endforeach
                                            </select>
                                            @error('client_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="mode_id">Mode de règlement</label>
                                            <select id="mode_id" name="mode_id" class="form-control" >
                                                <option value="">Sélectionnez un mode de règlement</option>
                                                @foreach($modes as $mode)
                                                    <option value="{{ $mode->id }}">{{ $mode->mode }}</option>
                                                @endforeach
                                            </select>
                                            @error('mode_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="date">Date</label>
                                            <input id="date" type="date" class="form-control" name="date" >
                                            @error('date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="montant">Montant</label>
                                            <input id="montant" type="number" step="0.01" class="form-control" name="montant" >
                                            @error('montant')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                    
                                        <button type="submit" class="btn btn-primary">Ajouter le règlement</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                
                                    </form>
                                </div>
        </div>
    </div>
</div>
                    
                   
                
 


@endsection

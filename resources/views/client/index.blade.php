@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Liste des clients</h2>
                    
                    <a href="{{ route('client.create') }}" class="btn btn-success">Ajouter un client</a>
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
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th>Ville</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{ $client->id }}</td>
                                    <td>{{ $client->nom }}</td>
                                    <td>{{ $client->prenom }}</td>
                                    <td>{{ $client->tell }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->adress }}</td>
                                    <td>{{ $client->ville }}</td>
                                    <td>
                                        <a href="{{ route('client.edit', $client->id) }}" class="btn btn-primary">Modifier</a>
                                        <form action="{{ route('client.destroy', $client->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                        
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalClient{{ $client->id }}">
                                            Détails
                                        </button>
                                        <!-- Bouton pour ouvrir le modal des règlements -->
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalReglements{{ $client->id }}">
                                            Règlements
                                        </button>
                                    </td>
                                </tr>

                                @endforeach
                        </tbody>
                    </table>
                    {{ $clients->links() }}
                    </div>
            </div>
        </div>
    </div>
</div>
                                <!-- Modal pour les détails du client -->
                                @foreach($clients as $client)
                                <div class="modal fade" id="modalClient{{ $client->id }}" tabindex="-1" aria-labelledby="modalClientLabel{{ $client->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalClientLabel{{ $client->id }}">Détails du client</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>ID du client :</strong> {{ $client->id }}</p>
                                                <p><strong>Nom :</strong> {{ $client->nom }}</p>
                                                <p><strong>Prénom :</strong> {{ $client->prenom }}</p>
                                                <p><strong>Téléphone :</strong> {{ $client->tell }}</p>
                                                <p><strong>Email :</strong> {{ $client->email }}</p>
                                                <p><strong>Adresse :</strong> {{ $client->adress }}</p>
                                                <p><strong>Ville :</strong> {{ $client->ville }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- Modal pour les règlements du client -->
                                @foreach($clients as $client)
                                <div class="modal fade" id="modalReglements{{ $client->id }}" tabindex="-1" aria-labelledby="modalReglementsLabel{{ $client->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalReglementsLabel{{ $client->id }}">Règlements de {{ $client->nom }} {{ $client->prenom }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <table class="table">
                            <tbody>
                    @if($client->reglements && count($client->reglements) > 0)
                        @foreach($client->reglements as $reglement)
                    <tr>
                    <td>{{ $reglement->id }}</td>
                    <td>{{ $reglement->date }}</td>
                    <td>{{ $reglement->montant }}</td>
                    <!-- Ajoutez d'autres données du règlement si nécessaire -->
                </tr>
            @endforeach
            @else
            <tr>
                <td colspan="3">Aucun règlement trouvé pour ce client.</td>
            </tr>
        @endif
    </tbody>
</table>

                                                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>        
                  
             
       @endforeach
@endsection

<link rel="stylesheet" href="{{asset('fontawesome-free-6.5.2-web/css/all.min.css')}}" >

@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Liste des ventes</h2>
                        <a href="{{ route('vente.create') }}" class="btn btn-success">Ajouter une vente</a>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Client</th>
                                    <th>Montant de cette vente</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ventes as $vente)
                                    <tr>
                                        <td>{{ $vente->id }}</td>
                                        <td>{{ $vente->date }}</td>
                                        <td>{{ $vente->client ? $vente->client->nom : 'Client non défini' }}</td>
                                        <td>
                                        @php
            $totalMontant = 0;
        @endphp

        @if($vente->detailsVente)
            @foreach($vente->detailsVente as $detail)
                @php
                    $qte = intval($detail->qte);
                    $prix = floatval($detail->prix);
                    $totalMontant += $qte * $prix;
                @endphp
            @endforeach
            {{ $totalMontant }}
        @else
            Aucun détail de vente
        @endif

                                        </td>
                                        <td>
                                            <!-- Actions -->
                                            <a href="{{ route('vente.edit', $vente->id) }}" class="btn-no-border">
                                            <i class="fa-solid fa-pen-to-square green-icon"></i>
                                            </a>
                                           <form action="{{ route('vente.destroy', $vente->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-no-border" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette vente ?')">
                                                <i class="fa-solid fa-trash-can red-icon"></i>
                                            </button>
                                            </form>

                                            <button type="button"  class="btn-no-border" data-bs-toggle="modal" data-bs-target="#modalDetailsVente{{ $vente->id }}">
                                            <i class="fa-solid fa-eye  black-icon"></i>
                                            </button>
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalvente{{ $vente->id }}">
                                            Détails vente
                                                </button>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addmodalvente">
                                                Add Vente
                                            </button>
                                            
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalDetailsVente{{ $vente->id }}" tabindex="-1" aria-labelledby="modalDetailsVenteLabel{{ $vente->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalDetailsVenteLabel{{ $vente->id }}">Détails de la vente</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>ID de la vente :</strong> {{ $vente->id }}</p>
                                                    <p><strong>Date :</strong> {{ $vente->date }}</p>
                                                    <p><strong>Client :</strong> {{ $vente->client->nom }}</p>
                                                    <p><strong>montant total de vente:</strong> {{ $totalMontant }}</p>
                                                    <!-- Ajoutez d'autres détails de vente ici -->
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
                        {{ $ventes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 <!-- Modal pour afficher les detail vente  de chaque vente -->
 @if($ventes && $ventes->count())
    @foreach($ventes as $vente)
        @php
            $totalMontant = 0; // Initialize the variable for the total
        @endphp
        <div class="modal fade" id="modalvente{{ $vente->id }}" tabindex="-1" aria-labelledby="modalvente{{ $vente->id }}Label" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalvente{{ $vente->id }}Label">Détails vente de {{ $vente->nom }} {{ $vente->prenom }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Article</th>
                                    <th>Date de vente</th>
                                    <th>Quantité</th>
                                    <th>Prix</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vente->detailsvente as $detailvent)
                                    <tr>
                                        <td>{{ $detailvent->article->designation }}</td>
                                        <td>{{ $detailvent->vente->date }}</td>
                                        <td>{{ $detailvent->qte }}</td>
                                        <td>{{ $detailvent->prix }}</td>
                                        <td>
                                            @php
                                                $Montant = floatval($detailvent->qte) * floatval($detailvent->prix);
                                                $totalMontant += $Montant; // Accumulate the amount in the total
                                                echo number_format($Montant, 2); // Format and display the amount
                                            @endphp
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <p>Total: {{ number_format($totalMontant, 2) }}</p> <!-- Display the total amount for this vente -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <p>No ventes available.</p>
@endif



<!-- Modal for adding vente details -->
<div class="modal fade" id="addmodalvente" tabindex="-1" aria-labelledby="addmodalventeLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addmodalventeLabel">Add Vente Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding vente details -->
                <form action="{{ route('details.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="vente_id" class="form-label">Vente</label>
                        <select class="form-select" id="vente_id" name="vente_id" required>
                            @foreach($ventes as $vente)
                                <option value="{{ $vente->id }}">{{ $vente->id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="article_id" class="form-label">Article</label>
                        <select class="form-select" id="article_id" name="article_id" required>
                            @foreach($articles as $article)
                                <option value="{{ $article->id }}">{{ $article->designation }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="qte" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="qte" name="qte" required>
                    </div>
                    <div class="form-group">
                        <label for="prix" class="form-label">Price</label>
                        <input type="number" class="form-control" id="prix" name="prix" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Detail</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<style>
.modal-dialog {
    max-width: 80%;
}

.table thead th {
    background-color: #f8f9fa;
    font-weight: bold;
    text-align: center;
}

.table tbody td {
    text-align: center;
    vertical-align: middle;
}
</style>


<style>
    .red-icon {
        color: red;
        font-size: 2em;
    }
    .btn-no-border {
        border: none;
        background-color: transparent;
        padding: 0; /* Optionnel : supprime le rembourrage par défaut du bouton */
    }
    .green-icon {
        color: green;
        font-size: 2em;
    }
    .black-icon{
        
        font-size: 2em;
    }
</style>
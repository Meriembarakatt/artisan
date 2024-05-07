<link rel="stylesheet" href="{{asset('fontawesome-free-6.5.2-web/css/all.min.css')}}" >

@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])

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
                                            <a href="{{ route('detailsvente.index', $vente->id) }}" class="btn btn-primary">Détails vente</a>
                                            
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
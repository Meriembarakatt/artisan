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
                    <h2>Liste des Bons de Réception</h2>
                    <a href="{{ route('bonreseption.create') }}" class="btn btn-success">Ajouter un Bon de Réception</a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Date</th>
                                <th scope="col">Artisan</th>
                                {{-- <th scope="col">montant total de vente</th> --}}
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bonreceptions as $bonreception)
                                <tr>
                                    <th scope="row">{{ $bonreception->id }}</th>
                                    <td>{{ $bonreception->date }}</td>
                                    <td>{{ $bonreception->artisan->nom }}</td>
                                    {{-- <td>
                                        @php
    $totalMontant = 0;
@endphp

@if($bonreception->details)
    @foreach($bonreception->details as $detail)
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

                                        </td> --}}
                                    <td>
                                        <a href="{{ route('bonreseption.edit', $bonreception->id) }}" class="btn btn-warning">Mod</a>
                                        <form action="{{ route('bonreseption.destroy', $bonreception->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce bon de réception ?')">Sup</button>
                                        </form>
                                        <!-- Bouton pour ouvrir le modal -->
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalBonReception{{ $bonreception->id }}">
                                            Détails
                                        </button>
                                        <a href="{{ route('details.create') }}" class="btn btn-success">Add un détail</a>
                     
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $bonreceptions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
@foreach ($bonreceptions as $bonreception)
<div class="modal fade" id="modalBonReception{{ $bonreception->id }}" tabindex="-1" aria-labelledby="modalBonReceptionLabel{{ $bonreception->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBonReceptionLabel{{ $bonreception->id }}">Détails du Bon de Réception</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID :</strong> {{ $bonreception->id }}</p>
                <p><strong>Date :</strong> {{ $bonreception->date }}</p>
                <p><strong>Artisan :</strong> {{ $bonreception->artisan->nom }}</p>
                
                <!-- Ajoutez d'autres détails ici -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

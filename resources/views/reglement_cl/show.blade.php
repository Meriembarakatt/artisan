@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Détails du Règlement Client</div>

                <div class="card-body">
                    <p><strong>ID:</strong> {{ $reglementCl->id }}</p>
                    <p><strong>Client:</strong> {{ $reglementCl->client->nom }}</p>
                    <p><strong>Mode de paiement:</strong> {{ $reglementCl->mode->nom }}</p>
                    <p><strong>Date:</strong> {{ $reglementCl->date }}</p>
                    <p><strong>Montant:</strong> {{ $reglementCl->montant }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

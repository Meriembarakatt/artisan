@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Confirmation de la mise à jour de la vente #{{ $vente->id }}
                    </div>
                    <div class="card-body">
                        <p>La vente a été mise à jour avec succès :</p>
                        <ul>
                            <li>Date de la vente : {{ $vente->date }}</li>
                            <li>Client : {{ $vente->client->nom }}</li>
                        </ul>
                        <a href="{{ route('vente.show', $vente->id) }}" class="btn btn-primary">Retour aux détails de la vente</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

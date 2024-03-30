@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Détails du règlement</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="client_id">Client :</label>
                            <input type="text" id="client_id" class="form-control" value="{{ $reglementCl->client->prenom }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="mode_id">Mode de règlement :</label>
                            <input type="text" id="mode_id" class="form-control" value="{{ $reglementCl->mode->mode }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="montant">Montant :</label>
                            <input type="text" id="montant" class="form-control" value="{{ $reglementCl->montant }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="date">Date :</label>
                            <input type="text" id="date" class="form-control" value="{{ $reglementCl->date }}" readonly>
                        </div>

                        <div class="form-group">
                            <a href="{{ route('reglement_cl.edit', $reglementCl->id) }}" class="btn btn-primary">Modifier</a>
                            <a href="{{ route('reglement_cl.index') }}" class="btn btn-secondary">Retour</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

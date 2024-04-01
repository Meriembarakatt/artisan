@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Détails du client
                        <a href="{{ route('client.index') }}" class="btn btn-primary float-right">Retour</a>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>ID:</strong> {{ $client->id }}</li>
                            <li class="list-group-item"><strong>Nom:</strong> {{ $client->nom }}</li>
                            <li class="list-group-item"><strong>Prénom:</strong> {{ $client->prenom }}</li>
                            <li class="list-group-item"><strong>Téléphone:</strong> {{ $client->tell }}</li>
                            <li class="list-group-item"><strong>Email:</strong> {{ $client->email }}</li>
                            <li class="list-group-item"><strong>Adresse:</strong> {{ $client->adress }}</li>
                            <li class="list-group-item"><strong>Ville:</strong> {{ $client->ville }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

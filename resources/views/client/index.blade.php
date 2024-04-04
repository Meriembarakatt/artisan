@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container mt-10">
        <div class="row">
            <div class="col-md-14">
                <div class="card">
                    <div class="card-header">
                        Liste des clients
                        <a href="{{ route('client.create') }}" class="btn btn-primary float-right">Ajouter un client</a>
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
                                            <a href="{{ route('client.show', $client->id) }}" class="btn btn-info">Voir</a>
                                            <a href="{{ route('client.edit', $client->id) }}" class="btn btn-primary">Modifier</a>
                                            <form action="{{ route('client.destroy', $client->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                            <a href="{{ route('reglements.client', $client->id) }}" class="btn btn-success">Règlement</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

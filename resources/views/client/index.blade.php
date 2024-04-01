@extends('layouts.app')

<<<<<<< HEAD
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Adresse</th>
            <th>Ville</th>
            <th>Téléphone</th>
            <th>Action</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($clients as $client)
        <tr>
            <td>{{ $client->nom }}</td>
            <td>{{$client->prenom }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ $client->adress }}</td>
            <td>{{ $client->ville }}</td>
            <td>{{ $client->tell }}</td>
            <td>
            <form action="{{ route('client.destroy', ['client' => $client->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
            

            </td>
           
        </tr>
        @endforeach
    </tbody>
</table>
=======
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container">
        <div class="row">
            <div class="col-md-12">
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
                                        </td>
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
>>>>>>> 2fe731ca63081007984f7172faeb9965c81b43d0

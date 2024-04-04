@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Liste des Règlements Clients</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="mb-3">
                        <a href="{{ route('reglement_cl.create') }}" class="btn btn-success">Ajouter un Règlement</a>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client</th>
                                <th>Mode</th>
                                <th>Date</th>
                                <th>Montant</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reglements as $reglement)
                                <tr>
                                    <td>{{ $reglement->id }}</td>
                                    <td>{{ $reglement->client->nom }}</td>
                                    <td>{{ $reglement->mode->mode }}</td>
                                    <td>{{ $reglement->date }}</td>
                                    <td>{{ $reglement->montant }}</td>
                                    <td>
                                        <a href="{{ route('reglement_cl.show', $reglement->id) }}" class="btn btn-primary btn-sm">Voir</a>
                                        <a href="{{ route('reglement_cl.edit', $reglement->id) }}" class="btn btn-success btn-sm">Éditer</a>
                                        <form action="{{ route('reglement_cl.destroy', $reglement->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce règlement client ?')">Supprimer</button>
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

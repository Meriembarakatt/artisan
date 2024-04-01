@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Liste des paiements artisans
                        <a href="{{ route('reglement_artisan.create') }}" class="btn btn-primary float-right">Ajouter un paiement</a>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Artisan</th>
                                    <th>Mode de paiement</th>
                                    <th>Date</th>
                                    <th>Montant</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($regArtisans as $regArtisan)
                                    <tr>
                                        <td>{{ $regArtisan->id }}</td>
                                        <td>{{ $regArtisan->artisan->nom }}</td>
                                        <td>{{ $regArtisan->mode->mode}}</td>
                                        <td>{{ $regArtisan->date }}</td>
                                        <td>{{ $regArtisan->montant }}</td>
                                        <td>
                                            <a href="{{ route('reglement_artisan.show', $regArtisan->id) }}" class="btn btn-info">Voir</a>
                                            <a href="{{ route('reglement_artisan.edit', $regArtisan->id) }}" class="btn btn-primary">Modifier</a>
                                            <form action="{{ route('reglement_artisan.destroy', $regArtisan->id) }}" method="POST" style="display: inline;">
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

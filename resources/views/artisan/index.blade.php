@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<div class="container mt-10">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                       <h1> Liste des artisan</h1>
                        <a href="{{ route('artisan.create') }}" class="btn btn-success mb-3">Ajouter un artisan</a>
                       
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
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($artisans as $artisan)
                    <tr>
                        <td>{{ $artisan->id }}</td>
                        <td>{{ $artisan->nom }}</td>
                        <td>{{ $artisan->prenom }}</td>
                        <td>{{ $artisan->email }}</td>
                        <td>
                            <a href="{{ route('artisan.show', $artisan->id) }}" class="btn btn-info">Voir</a>
                            <a href="{{ route('artisan.edit', $artisan->id) }}" class="btn btn-primary">Modifier</a>
                            <form action="{{ route('artisan.destroy', $artisan->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet artisan ?')">Supprimer</button>
                            </form>
                            <a href="{{ route('reglements.artisan', $artisan->id) }}" class="btn btn-success">Voir les paiements des artisans</a>
                                
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

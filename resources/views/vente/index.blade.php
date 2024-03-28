{{-- resources/views/ventes/index.blade.php
@extends('layouts.app')

@section('content')  --}}
<a href="{{ route('vente.create') }}">Ajouter vente </a>
<div class="container">
    <h1>Liste des Ventes</h1>
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>vente</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventes as $vente)
                <tr>
                    <td>{{ $vente->id }}</td>
                    <td>{{ $vente->date }}</td>
                    <td>{{ $vente->client->nom }}</td>
                    <td>
                    <form action="{{ route('vente.destroy', ['vente' => $vente->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <!-- Le reste de votre formulaire pour la suppression -->
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                   
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{--  @endsection  --}}

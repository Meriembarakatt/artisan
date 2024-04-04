@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Liste des Bons de Réception</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <a href="{{ route('bonreseption.create') }}" class="btn btn-success">Ajouter un Bon de Réception</a>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Artisan</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bonreceptions as $bonreception)
                                    <tr>
                                        <th scope="row">{{ $bonreception->id }}</th>
                                        <td>{{ $bonreception->date }}</td>
                                        <td>{{ $bonreception->artisan->nom }}</td>
                                        <td>
                                            <a href="{{ route('bonreseption.show', $bonreception->id) }}" class="btn btn-primary">Voir</a>
                                            <a href="{{ route('bonreseption.edit', $bonreception->id) }}" class="btn btn-warning">Modifier</a>
                                            <form action="{{ route('bonreseption.destroy', $bonreception->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce bon de réception ?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $bonreceptions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

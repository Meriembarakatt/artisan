@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
   
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Liste des Modes
                        <a href="{{ route('modes.create') }}" class="btn btn-primary float-right">Ajouter un Mode</a>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Mode</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($modes as $mode)
                                    <tr>
                                        <td>{{ $mode->id }}</td>
                                        <td>{{ $mode->mode }}</td>
                                        <td>
                                            <a href="{{ route('modes.show', $mode->id) }}" class="btn btn-info">Voir</a>
                                            <a href="{{ route('modes.edit', $mode->id) }}" class="btn btn-primary">Modifier</a>
                                            <form action="{{ route('modes.destroy', $mode->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce mode ?')">Supprimer</button>
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

@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
   
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Liste des familles
                    <a href="{{ route('familles.create') }}" class="btn btn-primary float-right">Ajouter une famille</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                     
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Famille</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($familles as $famille)
                                <tr>
                                    <td>{{ $famille->famille }}</td>
                                    <td>
                                        <form action="{{ route('familles.edit', $famille->id) }}" method="GET" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Éditer</button>
                                        </form>
                                        <form action="{{ route('familles.destroy', $famille->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette famille ?')">Supprimer</button>
                                        </form>
                                        <form action="{{ route('familles.show', $famille->id) }}" method="GET" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-info">Détails</button>
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

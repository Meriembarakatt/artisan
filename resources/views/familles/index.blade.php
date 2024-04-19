@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
   
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>liste des familles</h2>
                    <a href="{{ route('familles.create') }}" class="btn btn-success float-right">Ajouter une famille</a>
                </div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                     
                    <table class="table" class="container mt-10">
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
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalFamilleedit{{ $famille->id }}">
                                                modifier
                                            </button>
                                        </form>
                                        <form action="{{ route('familles.destroy', $famille->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette famille ?')">Supprimer</button>
                                        </form>
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalFamille{{ $famille->id }}">
                                            Détails
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal spécifique à chaque famille -->
                                <div class="modal fade" id="modalFamille{{ $famille->id }}" tabindex="-1" aria-labelledby="modalFamilleLabel{{ $famille->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalFamilleLabel{{ $famille->id }}">Détails de la famille</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>ID de la famille :</strong> {{ $famille->id }}</p>
                                                <p><strong>Nom de la famille :</strong> {{ $famille->famille }}</p>
                                                <!-- Ajoutez ici d'autres détails de la famille si nécessaire -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalFamilleedit{{ $famille->id }}" tabindex="-1" aria-labelledby="modalFamilleLabel{{ $famille->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalFamilleLabel{{ $famille->id }}">modifier  la famille</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            
                                                <div class="card-body">
                                                    <form action="{{ route('familles.update', $famille->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="famille">Nom de la Famille:</label>
                                                            <input type="text" class="form-control" id="famille" name="famille" value="{{ $famille->famille }}">
                                                        </div>
                                                        <!-- Ajoutez ici d'autres champs pour la famille si nécessaire -->
                                                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                                        <a href="{{ route('familles.index') }}" class="btn btn-primary">Annuler</a>
                                                   
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $familles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

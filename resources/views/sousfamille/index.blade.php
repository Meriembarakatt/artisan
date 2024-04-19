@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2> Liste des sous-familles</h2>
                   
                    <a href="{{ route('sousfamille.create') }}" class="btn btn-success float-right">Ajouter sous famille</a>
                    
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom de la sous-famille</th>
                                <th>Famille</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sousFamilles as $sousFamille)
                            <tr>
                                <td>{{ $sousFamille->id }}</td>
                                <td>{{ $sousFamille->name }}</td>
                                <td>{{ $sousFamille->famille->famille }}</td>
                                <td>
                                    <form action="{{ route('sousfamille.edit', $sousFamille->id) }}" method="GET" style="display: inline;">
                                        @csrf
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalSousFamilleedit{{ $sousFamille->id }}">
                                            modifier
                                        </button>
                                    </form>
                                    <form action="{{ route('sousfamille.destroy', $sousFamille->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette sous-famille ?')">Supprimer</button>
                                    </form>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalSousFamille{{ $sousFamille->id }}">
                                        Détails
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $sousFamilles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
@foreach($sousFamilles as $sousFamille)
<div class="modal fade" id="modalSousFamille{{ $sousFamille->id }}" tabindex="-1" aria-labelledby="modalSousFamilleLabel{{ $sousFamille->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSousFamilleLabel{{ $sousFamille->id }}">Détails de la sous-famille</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID de la sous-famille :</strong> {{ $sousFamille->id }}</p>
                <p><strong>Nom de la famille :</strong> {{  $sousFamille->famille->famille }}</p>
                <p><strong>Nom de la sous-famille :</strong> {{ $sousFamille->name }}</p>
                <!-- Ajoutez ici d'autres détails de la sous-famille si nécessaire -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- modal modifier --}}
@foreach($sousFamilles as $sousFamille)
<div class="modal fade" id="modalSousFamilleedit{{ $sousFamille->id }}" tabindex="-1" aria-labelledby="modalSousFamilleLabel{{ $sousFamille->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSousFamilleLabel{{ $sousFamille->id }}">modifier  la sous-famille</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
    
    <form method="POST" action="{{ route('sousfamille.update', $sousFamille->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="famille_id">Famille :</label>
            <select name="famille_id" id="famille_id" class="form-control">
                @foreach($familles as $famille)
                    <option value="{{ $famille->id }}" {{ $sousFamille->famille_id == $famille->id ? 'selected' : '' }}>{{ $famille->famille }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Nom de la Sous-famille :</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $sousFamille->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
            
        
    </form>
</div>
@endforeach
{{-- modal pour Ajouter --}}
@foreach($sousFamilles as $sousFamille)
<div class="modal fade" id="modalSousFamilleajouter{{ $sousFamille->id }}" tabindex="-1" aria-labelledby="modalSousFamilleLabel{{ $sousFamille->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSousFamilleLabel{{ $sousFamille->id }}">ajouter  la sous-famille</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
               
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('sousfamille.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="famille_id" class="form-label">Famille :</label>
                            <select name="famille_id" id="famille_id" class="form-control" required>
                                @foreach($familles as $famille)
                                    <option value="{{ $famille->id }}">{{ $famille->famille }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name" class="form-label">Nom de la Sous-famille :</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter la Sous-famille</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
 

@endsection

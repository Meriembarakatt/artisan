@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
   
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                       <h1> Liste des Modes</h1>
                        <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#modalAddMode">Ajouter un Mode</button>
                    </div>
                    <div class="card-body">
                        <div class="search-container">
                            <input type="text" id="searchInput" class="search-input" placeholder="Rechercher par mode..." onkeyup="searchModes()">
                            <button type="button" class="search-btn">Rechercher</button>
                        </div>
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
                                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#modalMode{{ $mode->id }}">
                                                Voir détails
                                            </button>
                                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditMode{{ $mode->id }}">Modifier</a>
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
                        {{-- {{ $modes->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal pour afficher détails --}}
    @foreach($modes as $mode)
    <div class="modal fade" id="modalMode{{ $mode->id }}" tabindex="-1" aria-labelledby="modalModeLabel{{ $mode->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalModeLabel{{ $mode->id }}">Détails de la mode</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>ID de la mode :</strong> {{ $mode->id }}</p>
                    <p><strong>Mode :</strong> {{ $mode->mode }}</p>
                    <!-- Ajoutez ici d'autres détails de la mode si nécessaire -->
                </div>
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
{{-- modal pour ajouter mode --}}
<div class="modal fade" id="modalAddMode" tabindex="-1" aria-labelledby="modalAddModeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddModeLabel">Ajouter un Mode</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('modes.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="mode" class="form-label">Mode</label>
                        <input type="text" class="form-control" id="mode" name="mode" placeholder="Entrez le mode">
                        @error('mode')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- modal pour modifier  --}}
@foreach($modes as $mode)
<div class="modal fade" id="modalEditMode{{ $mode->id }}" tabindex="-1" aria-labelledby="modalEditModeLabel{{ $mode->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditModeLabel{{ $mode->id }}">Modifier le Mode</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('modes.update', $mode->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="mode">Nom de la mode:</label>
                        <input type="text" class="form-control" id="mode" name="mode" value="{{ $mode->mode }}">
                    </div>
                    <!-- Ajoutez ici d'autres champs pour la famille si nécessaire -->
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    <a href="{{ route('modes.index') }}" class="btn btn-primary">Annuler</a>
               
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<script>
    function searchModes() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementsByClassName("table")[0];
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // Index 1 correspond à la colonne "Mode"
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
@endsection

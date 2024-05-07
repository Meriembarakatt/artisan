@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Liste des Bons de détail de Réception</h2>
                    <a href="{{ route('details.create') }}" class="btn btn-success">Ajouter un détail de Bon de Réception</a>
                        
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
  

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Article</th>
                                <th>Bon de Réception</th>
                                <th>Quantité</th>
                                <th>Prix</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail__brs as $detail)
                                <tr>
                                    <td>{{ $detail->id }}</td>
                                    <td>{{ $detail->article->designation }}</td>
                                    <td>{{ $detail->bonreception->date }}</td>
                                    <td>{{ $detail->qte }}</td>
                                    <td>{{ $detail->prix }}</td>
                                    <td>
                             
                                        <a href="{{ route('details.edit', $detail->id) }}" class="btn btn-warning">Modifier</a>
                                        <form action="{{ route('details.destroy', ['detail' => $detail->id]) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                        <!-- Bouton pour ouvrir le modal -->
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $detail->id }}">
                                            Détails
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="modalDetail{{ $detail->id }}" tabindex="-1" aria-labelledby="modalDetailLabel{{ $detail->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalDetailLabel{{ $detail->id }}">Détails du Bon de Détail de Réception</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>ID :</strong> {{ $detail->id }}</p>
                                                <p><strong>Article :</strong> {{ $detail->article->designation }}</p>
                                                <p><strong>Bon de Réception :</strong> {{ $detail->bonreception->date }}</p>
                                                <p><strong>Quantité :</strong> {{ $detail->qte }}</p>
                                                <p><strong>Prix :</strong> {{ $detail->prix }}</p>
                                                <!-- Ajoutez d'autres détails ici -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $detail__brs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

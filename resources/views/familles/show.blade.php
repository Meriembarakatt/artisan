@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])

<div class="container mt-10">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-4">Détails de la famille</h2>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                <strong>ID de la famille :</strong> {{ $famille->id }}
                            </div>
                            <div class="card-body">
                                <p><strong>Nom de la famille :</strong> {{ $famille->famille }}</p>
                                <!-- Ajoutez ici d'autres détails de la famille si nécessaire -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- Bouton pour ouvrir le modal -->
                    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modalFamille">
                        Afficher le modal
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalFamille" tabindex="-1" role="dialog" aria-labelledby="modalFamilleLabel" aria-hidden="true" data-backdrop="static">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalFamilleLabel">Détails de la famille</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>ID de la famille :</strong> {{ $famille->id }}</p>
                                    <p><strong>Nom de la famille :</strong> {{ $famille->famille }}</p>
                                    <!-- Ajoutez ici d'autres détails de la famille si nécessaire -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

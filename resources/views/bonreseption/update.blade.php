@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Mise à Jour du Bon de Réception</div>

                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            Bon de réception mis à jour avec succès!
                        </div>

                        <a href="{{ route('bonreseption.index') }}" class="btn btn-primary">Retour à la liste</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="alert alert-success" role="alert">
                    Détail de bon de réception mis à jour avec succès.
                </div>
                <a href="{{ route('details.index') }}" class="btn btn-primary">Retour à la liste des détails de bon de réception</a>
            </div>
        </div>
    </div>
@endsection

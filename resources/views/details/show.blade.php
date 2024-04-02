@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Détails du Bon de Réception</h1>

        <div class="card">
            <div class="card-header">ID: {{ $detail_Br->id }}</div>

            <div class="card-body">
                <p><strong>Article:</strong> {{ $detail_Br->article->designation }}</p>
                <p><strong>Bon de Réception:</strong> {{ $detail_Br->bonreception->date }}</p>
                <p><strong>Quantité:</strong> {{ $detail_Br->qte }}</p>
                <p><strong>Prix:</strong> {{ $detail_Br->prix }}</p>
            </div>
        </div>

        <a href="{{ route('details.index') }}" class="btn btn-primary mt-3">Retour à la liste des détails de bon de réception</a>
    </div>
@endsection

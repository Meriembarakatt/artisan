@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Détails de la vente #{{ $vente->id }}
                    </div>
                    <div class="card-body">
                        <p>Date de la vente : {{ $vente->date }}</p>
                        <p>Client : {{ $vente->client->nom }}</p>
                        <p>Articles vendus :</p>
                        <ul>
                            @if($vente->details)
                                @foreach($vente->details as $detail)
                                    <li>{{ $detail->article->nom }} - Quantité: {{ $detail->quantite }} - Prix unitaire: {{ $detail->prix }}</li>
                                @endforeach
                            @else
                                <li>Aucun détail de vente trouvé</li>
                            @endif
                        </ul>
                        <a href="{{ route('vente.edit', $vente->id) }}" class="btn btn-primary">Modifier</a>
                        <form action="{{ route('vente.destroy', $vente->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette vente ?')">Supprimer</button>
                        </form>
                        <a href="{{ route('vente.index') }}" class="btn btn-secondary">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

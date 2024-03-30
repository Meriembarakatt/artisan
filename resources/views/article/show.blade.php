@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Détails de l'Article</div>

                    <div class="card-body">
                        <div>
                            <strong>Désignation:</strong> {{ $article->designation }}
                        </div>
                        <div>
                            <strong>Prix HT:</strong> {{ $article->prix_ht }}
                        </div>
                        <div>
                            <strong>Quantité:</strong> {{ $article->qte }}
                        </div>
                        <div>
                            <strong>Stock:</strong> {{ $article->stock }}
                        </div>
                        <div>
                            <strong>Sous-famille:</strong> {{ $article->sousFamille->name }}
                        </div>
                        <div>
                            @if ($article->image)
                                <strong>Image:</strong>
                                <img src="{{ asset('storage/' . $article->image) }}" alt="Image de l'article" style="max-width: 200px;">
                            @else
                                <div>Aucune image disponible</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- resources/views/details/create.blade.php

@extends('layouts.app')

@section('content') --}}
<div class="container">
    <h1>Ajouter un Détail de Vente</h1>
    <form action="{{ route('detailsvente.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="article_id">Article</label>
            <select class="form-control" id="article_id" name="article_id" required>
                @foreach ($articles as $article)
                    <option value="{{ $article->id }}">{{ $article->designation}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="vente_id">Vente</label>
            <select class="form-control" id="vente_id" name="vente_id" required>
                @foreach ($ventes as $vente)
                    <option value="{{ $vente->id }}">{{ $vente->date }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="qte">Quantité</label>
            <input type="text" class="form-control" id="qte" name="qte" required>
        </div>
        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="text" class="form-control" id="prix" name="prix" required>
        </div>
        <!-- Ajoutez d'autres champs si nécessaire -->

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>


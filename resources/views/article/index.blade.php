@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Liste des Articles</div>

                    <div class="card-body">
                        <a href="{{ route('article.create') }}" class="btn btn-success mb-3">Ajouter un Article</a>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Désignation</th>
                                    <th>Prix HT</th>
                                    <th>Quantité</th>
                                    <th>Stock</th>
                                    <th>Sous-famille</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                    <tr>
                                        <td>{{ $article->id }}</td>
                                        <td>{{ $article->designation }}</td>
                                        <td>{{ $article->prix_ht }}</td>
                                        <td>{{ $article->qte }}</td>
                                        <td>{{ $article->stock }}</td>
                                        <td>{{ $article->sousFamille->name }}</td>
                                        <td>
                                            @if ($article->image)
                                                <img src="{{ asset('storage/' . $article->image) }}" alt="Image de l'article" style="max-width: 100px;">
                                            @else
                                                Aucune image disponible
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('article.show', $article->id) }}" class="btn btn-primary">Voir</a>
                                            <a href="{{ route('article.edit', $article->id) }}" class="btn btn-warning">Modifier</a>
                                            <form action="{{ route('article.destroy', $article->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

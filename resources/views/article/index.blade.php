@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2> Liste des articles</h2>
                   
                    <a href="{{ route('article.create') }}" class="btn btn-success mb-3">Ajouter un article</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

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
                                    <a href="{{ route('article.edit', $article->id) }}" class="btn btn-success mb-3">
                                        <i class="bi bi-pencil"></i> Modifier
                                    </a>
                                    <form action="{{ route('article.destroy', $article->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article?')">
                                            <i class="bi bi-trash"></i> Supprimer
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalArticle{{ $article->id }}">
                                        <i class="bi bi-info-circle"></i> Détails
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $articles->links() }}

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
@foreach ($articles as $article)
<div class="modal fade" id="modalArticle{{ $article->id }}" tabindex="-1" aria-labelledby="modalArticleLabel{{ $article->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalArticleLabel{{ $article->id }}">Détails de l'article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID de l'article :</strong> {{ $article->id }}</p>
                <p><strong>Désignation :</strong> {{ $article->designation }}</p>
                <p><strong>Prix HT :</strong> {{ $article->prix_ht }}</p>
                <p><strong>Quantité :</strong> {{ $article->qte }}</p>
                <p><strong>Stock :</strong> {{ $article->stock }}</p>
                <p><strong>Sous-famille :</strong> {{ $article->sousFamille->name }}</p>
                @if ($article->image)
                <img src="{{ asset('storage/' . $article->image) }}" alt="Image de l'article" style="max-width: 200px;">
                @else
                Aucune image disponible
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

@endforeach
<!-- Modal for editing an article -->
@foreach ($articles as $article)
<div class="modal fade" id="modalEditArticle{{ $article->id }}" tabindex="-1" aria-labelledby="modalEditArticleLabel{{ $article->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditArticleLabel{{ $article->id }}">Modifier l'article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="designation{{ $article->id }}">Désignation:</label>
                        <input type="text" name="designation" class="form-control" id="designation{{ $article->id }}" value="{{ $article->designation }}" required>
                    </div>
                    <!-- Add other form fields for editing -->
                    <!-- Similar to the create form, but with values from $article -->
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
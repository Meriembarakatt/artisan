@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
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
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalArticleedit{{ $article->id }}">
                                        modifier
                                    </button>
                                    <form action="{{ route('article.destroy', $article->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article?')">Supprimer</button>
                                    </form>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalArticle{{ $article->id }}">
                                        Détails
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

{{-- modal pour modifier article --}}
@foreach ($articles as $article)
<div class="modal fade" id="modalArticleedit{{ $article->id }}" tabindex="-1" aria-labelledby="modalArticleLabel{{ $article->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalArticleLabel{{ $article->id }}">modifier  l'article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

                <div class="card-body">
                    <form action="{{ route('article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="designation">Désignation:</label>
                            <input type="text" name="designation" class="form-control" id="designation" value="{{ $article->designation }}" required>
                        </div>
                        <div class="form-group">
                            <label for="prix_ht">Prix HT:</label>
                            <input type="number" name="prix_ht" class="form-control" id="prix_ht" value="{{ $article->prix_ht }}" required>
                        </div>
                        <div class="form-group">
                            <label for="qte">Quantité:</label>
                            <input type="number" name="qte" class="form-control" id="qte" value="{{ $article->qte }}" required>
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock:</label>
                            <input type="number" name="stock" class="form-control" id="stock" value="{{ $article->stock }}" required>
                        </div>
                        <div class="form-group">
                            <label for="sousfamille_id">Sous-famille:</label>
                            {{-- <select name="sousfamille_id" class="form-control" id="sousfamille_id" >
                                @foreach ($sousFamilles as $sousFamille)
                                    <option value="{{ $sousFamille->id }}" {{ $article->sousfamille_id == $sousFamille->id ? 'selected' : '' }}>{{ $sousFamille->name }}</option>
                                @endforeach
                            </select> --}}
                          
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" name="image" class="form-control-file" id="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                        <button><a href="{{ route('article.index') }}" class="btn btn-primary">Annuler</a></button>
                   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
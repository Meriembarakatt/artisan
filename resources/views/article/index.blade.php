<link rel="stylesheet" href="{{asset('fontawesome-free-6.5.2-web/css/all.min.css')}}" >

@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl
        {{ str_contains(Request::url(), 'virtual-reality') == true ? ' mt-3 mx-3 bg-primary' : '' }}" id="navbarBlur"
        data-scroll="false">
<!-- input recherche -->
<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        <div class="input-group">
            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
            <input type="search" class="form-control" placeholder="Type here..." name="search" id="search">
        </div>
    </div>
    <!-- end input recherche -->
 <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <form role="form" method="post" action="http://127.0.0.1:8000/logout" id="logout-form">
                        <input type="hidden" name="_token" value="565i2z501PCFGkpUT0iFXh85OU0fngfPNDa8GZmu">                        <a href="http://127.0.0.1:8000/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link text-white font-weight-bold px-0">
                            <i class="fa fa-user me-sm-1" aria-hidden="true"></i>
                            <span class="d-sm-inline d-none">Log out</span>
                        </a>
                    </form>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>

    </div> 
   </nav>

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
                                <th>Désignation</th>
                                <th>Prix HT</th>
                              
                                <th>Stock</th>
                                <th>Sous-famille</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody  class="alldata">
                            @foreach ($articles as $article)
                            <tr>
                                <td>{{ $article->designation }}</td>
                                <td>{{ $article->prix_ht }}</td>
                               
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
                                    <a href="{{ route('article.edit', $article->id) }}" class="btn-no-border">
                                    <i class="fa-solid fa-pen-to-square green-icon"></i>
                                    </a>
                                    <form action="{{ route('article.destroy', $article->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-no-border" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article?')">
                                        <i class="fa-solid fa-trash-can red-icon"></i>
                                        </button>
                                    </form>
                                    <button type="button"  class="btn-no-border" data-bs-toggle="modal" data-bs-target="#modalArticle{{ $article->id }}">
                                    <i class="fa-solid fa-eye  black-icon"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tbody id="Content" class="searchdata">
                            <!-- Les données de la recherche seront affichées ici -->
                        </tbody>
                    </table>
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#search').on('keyup', function() {
        $value = $(this).val();
        if($value){
            $('.alldata').hide();
            $('.searchdata').show();

        }
        else{
            $('.alldata').show();
            $('.searchdata').hide();
        }
        $.ajax({
            url: '{{ URL::to('searcharticle') }}',
            type: 'GET',
            data: { 'search': $value },
            success: function(data) {
                console.log(data);
                $('#Content').html(data);
            }
        })
    })
</script>

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
<style>
    .red-icon {
        color: red;
        font-size: 2em;
    }
    .btn-no-border {
        border: none;
        background-color: transparent;
        padding: 0; /* Optionnel : supprime le rembourrage par défaut du bouton */
    }
    .green-icon {
        color: green;
        font-size: 2em;
    }
    .black-icon{
        
        font-size: 2em;
    }
</style>
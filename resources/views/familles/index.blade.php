@extends('layouts.app')

@section('content')

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
                    <h2>Liste des familles</h2>
                    <a href="{{ route('familles.create') }}" class="btn btn-success float-right">Ajouter une famille</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table" class="container mt-10">
                        <thead>
                            <tr>
                                <th>Famille</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody  class="alldata">
                        @foreach ($familles as $famille)
                            <tr>
                                <td>{{ $famille->famille }}</td>
                                <td>
                                    <form action="{{ route('familles.edit', $famille->id) }}" method="GET" style="display: inline;">
                                        @csrf
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalFamilleedit{{ $famille->id }}">
                                            Modifier
                                        </button>
                                    </form>
                                    <form action="{{ route('familles.destroy', $famille->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette famille ?')">Supprimer</button>
                                    </form>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalFamille{{ $famille->id }}">
                                        Détails
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tbody id="Content" class="searchdata">
                            <!-- Les données de la recherche seront affichées ici -->
                        </tbody>
                    </table>
                    {{ $familles->links() }}
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
            url: '{{ URL::to('searchfamille') }}',
            type: 'GET',
            data: { 'search': $value },
            success: function(data) {
                console.log(data);
                $('#Content').html(data);
            }
        })
    })
</script>
<!-- Modal spécifique à chaque famille -->
@foreach ($familles as $famille)
<div class="modal fade" id="modalFamille{{ $famille->id }}" tabindex="-1" aria-labelledby="modalFamilleLabel{{ $famille->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFamilleLabel{{ $famille->id }}">Détails de la famille</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID de la famille :</strong> {{ $famille->id }}</p>
                <p><strong>Nom de la famille :</strong> {{ $famille->famille }}</p>
                <!-- Ajoutez ici d'autres détails de la famille si nécessaire -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal pour modifier la famille -->
@foreach ($familles as $famille)
<div class="modal fade" id="modalFamilleedit{{ $famille->id }}" tabindex="-1" aria-labelledby="modalFamilleLabel{{ $famille->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFamilleLabel{{ $famille->id }}">Modifier la famille</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('familles.update', $famille->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="famille">Nom de la Famille:</label>
                        <input type="text" class="form-control" id="famille" name="famille" value="{{ $famille->famille }}">
                    </div>
                    <!-- Ajoutez ici d'autres champs pour la famille si nécessaire -->
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


@endsection


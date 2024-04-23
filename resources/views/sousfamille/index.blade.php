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
            <input type="search" class="form-control" placeholder="Type here..." name="search2" id="search2">
        </div>
    </div>
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
                    <h2> Liste des sous-familles</h2>
                   
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAjoutersousfamille">
                        Ajouter une Sous-famille
                    </button>
                    
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom de la sous-famille</th>
                                <th>Famille</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="alldata">
                            @foreach($sousFamilles as $sousFamille)
                            <tr>
                                <td>{{ $sousFamille->name }}</td>
                                <td>{{ $sousFamille->famille->famille }}</td>
                                <td>
                                    <form action="{{ route('sousfamille.edit', $sousFamille->id) }}" method="GET" style="display: inline;">
                                        @csrf
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalSousFamilleedit{{ $sousFamille->id }}">
                                            modifier
                                        </button>
                                    </form>
                                    <form action="{{ route('sousfamille.destroy', $sousFamille->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette sous-famille ?')">Supprimer</button>
                                    </form>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalSousFamille{{ $sousFamille->id }}">
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
                    {{ $sousFamilles->links() }}
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $('#search2').on('keyup', function() {
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
            url: '{{ URL::to('searchSousFamilles') }}',
            type: 'GET',
            data: { 'search': $value },
            success: function(data) {
                console.log(data);
                $('#Content').html(data);
            }
        })
    })
</script>


  <!-- modal pour ajouter sous famille -->
    <div class="modal fade" id="modalAjoutersousfamille" tabindex="-1" aria-labelledby="modalAjoutersousfamilleLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAjoutersousfamilleLabel">Ajouter une Sous-famille</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sousfamille.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="famille_id" class="form-label">Famille :</label>
                            <select name="famille_id" id="famille_id" class="form-control" required>
                                @foreach($familles as $famille)
                                    <option value="{{ $famille->id }}">{{ $famille->famille }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name" class="form-label">Nom de la Sous-famille :</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Ajouter la Sous-famille</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
@foreach($sousFamilles as $sousFamille)
<div class="modal fade" id="modalSousFamille{{ $sousFamille->id }}" tabindex="-1" aria-labelledby="modalSousFamilleLabel{{ $sousFamille->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSousFamilleLabel{{ $sousFamille->id }}">Détails de la sous-famille</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID de la sous-famille :</strong> {{ $sousFamille->id }}</p>
                <p><strong>Nom de la famille :</strong> {{  $sousFamille->famille->famille }}</p>
                <p><strong>Nom de la sous-famille :</strong> {{ $sousFamille->name }}</p>
                <!-- Ajoutez ici d'autres détails de la sous-famille si nécessaire -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- modal modifier --}}
@foreach($sousFamilles as $sousFamille)
<div class="modal fade" id="modalSousFamilleedit{{ $sousFamille->id }}" tabindex="-1" aria-labelledby="modalSousFamilleLabel{{ $sousFamille->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSousFamilleLabel{{ $sousFamille->id }}">modifier  la sous-famille</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
    
    <form method="POST" action="{{ route('sousfamille.update', $sousFamille->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="famille_id">Famille :</label>
            <select name="famille_id" id="famille_id" class="form-control">
                @foreach($familles as $famille)
                    <option value="{{ $famille->id }}" {{ $sousFamille->famille_id == $famille->id ? 'selected' : '' }}>{{ $famille->famille }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Nom de la Sous-famille :</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $sousFamille->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
            
        
    </form>
</div>
@endforeach


@endsection

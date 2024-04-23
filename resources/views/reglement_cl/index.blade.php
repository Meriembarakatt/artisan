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
                    <h2> Liste des Règlements Clients</h2>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAddReglement">
                        Ajouter un règlement
                    </button>
                </div>

                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                               
                                <th>Client</th>
                                <th>Mode</th>
                                <th>Date</th>
                                <th>Montant</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody  class="alldata">
                            @foreach($reglements as $reglement)
                            <tr>
                               
                                <td>{{ $reglement->client->nom }} {{ $reglement->client->prenom }}</td>
                                <td>{{ $reglement->mode->mode }}</td>
                                <td>{{ $reglement->date }}</td>
                                <td>{{ $reglement->montant }}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalModifierReglement{{ $reglement->id }}">
                                        Modifier
                                    </button>

                                    <form action="{{ route('reglement_cl.destroy', $reglement->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce règlement client ?')">Supprimer</button>
                                    </form>

                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetailsReglement{{ $reglement->id }}">
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
                    {{ $reglements->links() }}
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
        console.log('fdg');
        $.ajax({
            url: '{{ URL::to('searchreglementCl') }}',
            type: 'GET',
            data: { 'search': $value },
            success: function(data) {
                console.log(data);
                $('#Content').html(data);
            }
        })
    })
</script>



<!-- Modal de détails de règlement -->
@foreach($reglements as $reglement)
<div class="modal fade" id="modalDetailsReglement{{ $reglement->id }}" tabindex="-1" aria-labelledby="modalDetailsReglementLabel{{ $reglement->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailsReglementLabel{{ $reglement->id }}">Détails du règlement client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID :</strong> {{ $reglement->id }}</p>
                <p><strong>Client :</strong> {{ $reglement->client->nom }}  {{ $reglement->client->prenom }}</p>
                <p><strong>Mode de règlement :</strong> {{ $reglement->mode->mode }}</p>
                <p><strong>Date :</strong> {{ $reglement->date }}</p>
                <p><strong>Montant :</strong> {{ $reglement->montant }}</p>
                <!-- Ajoutez d'autres détails du règlement ici -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endforeach
                          
{{-- modal Modifier un règlement de client --}}
@foreach($reglements as $reglement)
<div class="modal fade" id="modalModifierReglement{{ $reglement->id }}" tabindex="-1" aria-labelledby="modalModifierReglementLabel{{ $reglement->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalModifierReglementLabel{{ $reglement->id }}">Modifier le règlement client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('reglement_cl.update', $reglement->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="client_id">Client :</label>
                        <select name="client_id" id="client_id" class="form-control">
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" {{ $client->id == $reglement->client_id ? 'selected' : '' }}>{{ $client->prenom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mode_id">Mode de règlement :</label>
                        <select name="mode_id" id="mode_id" class="form-control">
                            @foreach ($modes as $mode)
                                <option value="{{ $mode->id }}" {{ $mode->id == $reglement->mode_id ? 'selected' : '' }}>{{ $mode->mode }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="montant">Montant :</label>
                        <input type="text" name="montant" id="montant" class="form-control" value="{{ $reglement->montant }}" required>
                    </div>

                    <div class="form-group">
                        <label for="date">Date :</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ $reglement->date }}" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- modal pour aajouter  --}}<!-- Modal -->
<div class="modal fade" id="modalAddReglement" tabindex="-1" aria-labelledby="modalAddReglementLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalAddReglementLabel">Ajouter un règlement pour le client</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('reglement_cl.store') }}">
                                        @csrf

                                        <div class="form-group">
                                            <label for="client_id">Client</label>
                                            <select id="client_id" name="client_id" class="form-control">
                                                @foreach($clients as $client)
                                                    <option value="{{ $client->id }}">{{ $client->nom }} {{ $client->prenom }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="mode_id">Mode de règlement</label>
                                            <select id="mode_id" name="mode_id" class="form-control">
                                                @foreach($modes as $mode)
                                                    <option value="{{ $mode->id }}">{{ $mode->mode }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="date">Date</label>
                                            <input id="date" type="date" class="form-control" name="date" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="montant">Montant</label>
                                            <input id="montant" type="number" step="0.01" class="form-control" name="montant" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Ajouter le règlement</button>
                                    </form>
                                </div>
        </div>
    </div>
</div>
                    
                   
            

@endsection

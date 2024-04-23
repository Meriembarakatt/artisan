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
            <input type="search" class="form-control" placeholder="Type here..." name="search3" id="search3">
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
<div  class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Liste des clients</h2>
                    
                    <a href="{{ route('client.create') }}" class="btn btn-success">Ajouter un client</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                              
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th>Ville</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody  class="alldata">
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{ $client->nom }}</td>
                                    <td>{{ $client->prenom }}</td>
                                    <td>{{ $client->tell }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->adress }}</td>
                                    <td>{{ $client->ville }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalClientedit{{ $client->id }}">
                                        modifier
                                        </button>
                                        <form action="{{ route('client.destroy', $client->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                        
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalClient{{ $client->id }}">
                                            Détails
                                        </button>
                                        <!-- Bouton pour ouvrir le modal des règlements -->
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalReglements{{ $client->id }}">
                                            voir tout les Règlements
                                        </button>
                                    </td>
                                </tr>

                                @endforeach
                        </tbody>
                        <tbody id="Content" class="searchdata">
                         <!-- Les données de la recherche seront affichées ici -->
                    </tbody>
                    </table>
                    {{ $clients->links() }}
                    </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#search3').on('keyup', function() {
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
            url: '{{ URL::to('searchclient') }}',
            type: 'GET',
            data: { 'search': $value },
            success: function(data) {
                console.log(data);
                $('#Content').html(data);
            }
        })
    })
</script>



        <!-- Modal pour les détails du client -->
                     @foreach($clients as $client)
                                <div class="modal fade" id="modalClient{{ $client->id }}" tabindex="-1" aria-labelledby="modalClientLabel{{ $client->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalClientLabel{{ $client->id }}">Détails du client</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>ID du client :</strong> {{ $client->id }}</p>
                                                <p><strong>Nom :</strong> {{ $client->nom }}</p>
                                                <p><strong>Prénom :</strong> {{ $client->prenom }}</p>
                                                <p><strong>Téléphone :</strong> {{ $client->tell }}</p>
                                                <p><strong>Email :</strong> {{ $client->email }}</p>
                                                <p><strong>Adresse :</strong> {{ $client->adress }}</p>
                                                <p><strong>Ville :</strong> {{ $client->ville }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- Modal pour les règlements du client -->
                                @foreach($clients as $client)
                                @php
                                $totalMontant = 0; // Initialisez la variable pour le total
                            @endphp
                                <div class="modal fade" id="modalReglements{{ $client->id }}" tabindex="-1" aria-labelledby="modalReglementsLabel{{ $client->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalReglementsLabel{{ $client->id }}">Règlements de {{ $client->nom }} {{ $client->prenom }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <table class="table">
                            <tbody>
                    @if($client->reglements && count($client->reglements) > 0)
                        @foreach($client->reglements as $reglement)
                    <tr>
                    <td>{{ $reglement->id }}</td>
                    <td>{{ $reglement->date }}</td>
                    <td>{{ $reglement->montant }}</td>
                    <!-- Ajoutez d'autres données du règlement si nécessaire -->
                </tr>
                @php
                $totalMontant += $reglement->montant; // Accumulez le montant dans le total
            @endphp
             <div class="total-montant">Total : {{ $totalMontant }}</div> <!-- Affichez le total après la boucle -->
            
            @endforeach
            @else
            <tr>
                <td colspan="3">Aucun règlement trouvé pour ce client.</td>
            </tr>
        @endif
    </tbody>
</table>

                                                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>        
                  
             
       @endforeach
{{-- modal modifier client --}}

@foreach($clients as $client)
<div class="modal fade" id="modalClientedit{{ $client->id }}" tabindex="-1" aria-labelledby="modalClientLabel{{ $client->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalClientLabel{{ $client->id }}">modifier client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
                    <div class="card-body">
                        <form action="{{ route('client.update', $client->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" id="nom" class="form-control" value="{{ $client->nom }}">
                            </div>
                            <div class="form-group">
                                <label for="prenom">Prénom</label>
                                <input type="text" name="prenom" id="prenom" class="form-control" value="{{ $client->prenom }}">
                            </div>
                            <div class="form-group">
                                <label for="tell">Téléphone</label>
                                <input type="text" name="tell" id="tell" class="form-control" value="{{ $client->tell }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $client->email }}">
                            </div>
                            <div class="form-group">
                                <label for="adress">Adresse</label>
                                <input type="text" name="adress" id="adress" class="form-control" value="{{ $client->adress }}">
                            </div>
                            <div class="form-group">
                                <label for="ville">Ville</label>
                                <input type="text" name="ville" id="ville" class="form-control" value="{{ $client->ville }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <button type="submit" class="btn btn-primary">fermer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endforeach
@endsection

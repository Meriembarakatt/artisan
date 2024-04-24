<link rel="stylesheet" href="{{asset('fontawesome-free-6.5.2-web/css/all.min.css')}}" >

@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
        <div class="col-mt-12">
            <div class="card">
                <div class="card-header">
                    <h2> Liste des artisans </h2>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAjouterArtisan">
                        Ajouter un artisan
                    </button> </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                             
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>password</th> 
                                <th>ville</th>
                                <th>Adresse</th> 
                                <th>telephone</th> 
                               <th>function</th> 
                                <th>Actions</th>
                                <th>règlements</th>
                            </tr>
                        </thead>
                        <tbody class="alldata">
                            @foreach($artisans as $artisan)
                            <tr>
                                <td>{{ $artisan->nom }}</td>
                                <td>{{ $artisan->prenom }}</td>
                                <td>{{ $artisan->email }}</td>
                               <td>{{ $artisan->password }}</td> 
                                <td>{{ $artisan->ville }}</td>
                                 <td>{{ $artisan->adress }}</td>
                                <td>{{ $artisan->tell }}</td>
                                <td>{{ $artisan->fonction }}</td> 
                                <td>
                                     <!-- modefier -->
                                    <button type="button"  class="btn-no-border" data-bs-toggle="modal" data-bs-target="#modalArtisanedit{{ $artisan->id }}">
                                    <i class="fa-solid fa-pen-to-square green-icon"></i>
                                    </button>
                                     <!-- Supprimer -->
                                    <form action="{{ route('artisan.destroy', $artisan->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"  class="btn-no-border" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet artisan ?')">
                                        <i class="fa-solid fa-trash-can red-icon"></i>
                                    </button>
                                    </form>
                                    <!-- Bouton pour ouvrir le modal -->
                                     <!-- Détails -->
                                    <button type="button"  class="btn-no-border" data-bs-toggle="modal" data-bs-target="#modalArtisan{{ $artisan->id }}">
                                    <i class="fa-solid fa-eye  black-icon"></i>
                                    </button>
                                    <!-- Bouton pour ouvrir le modal des règlements -->
                                    </td>
                                    <td class="text-center">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalReglements{{ $artisan->id }}">
                                        Règ
                                    </button>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addReglementModal">
                                        Add Règ
                                      </button>
                                      
                                      
                                    
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tbody id="Content" class="searchdata">
                            <!-- Les données de la recherche seront affichées ici -->
                        </tbody>
                    </table>
                    
                    {{ $artisans->links() }}
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
            url: '{{ URL::to('searchartisant') }}',
            type: 'GET',
            data: { 'search': $value },
            success: function(data) {
                console.log(data);
                $('#Content').html(data);
            }
        })
    })
</script>


@foreach($artisans as $artisan)
<div class="modal fade" id="modalArtisanedit{{ $artisan->id }}" tabindex="-1" aria-labelledby="modalArtisan{{ $artisan->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalArtisan{{ $artisan->id }}Label">Modifier l'artisan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('artisan.update', $artisan->id) }}" method="POST">
                @csrf
                @method('PUT')
    
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{ $artisan->nom }}">
                    </div>
    
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $artisan->prenom }}">
                    </div>
    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $artisan->email }}">
                    </div>
    
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Entrez un nouveau mot de passe">
                    </div>
    
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" value="{{ $artisan->adresse }}">
                    </div>
    
                    <div class="form-group">
                        <label for="ville">Ville</label>
                        <input type="text" class="form-control" id="ville" name="ville" value="{{ $artisan->ville }}">
                    </div>
    
                    <div class="form-group">
                        <label for="tell">Téléphone</label>
                        <input type="text" class="form-control" id="tell" name="tell" value="{{ $artisan->tell }}">
                    </div>
    
                    <div class="form-group">
                        <label for="fonction">Fonction</label>
                        <input type="text" class="form-control" id="fonction" name="fonction" value="{{ $artisan->fonction }}">
                    </div>
                </div>
    
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    <a href="{{ route('artisan.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

                       


<!-- Modal pour afficher les détails de chaque artisan -->
@foreach($artisans as $artisan)
<div class="modal fade" id="modalArtisan{{ $artisan->id }}" tabindex="-1" aria-labelledby="modalArtisan{{ $artisan->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalArtisan{{ $artisan->id }}Label">Détails de l'artisan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID :</strong> {{ $artisan->id }}</p>
                <p><strong>Nom :</strong> {{ $artisan->nom }}</p>
                <p><strong>Prénom :</strong> {{ $artisan->prenom }}</p>
                <p><strong>Email :</strong> {{ $artisan->email }}</p>
                <p><strong>password :</strong> {{ $artisan->password }}</p>
                <p><strong>adresse :</strong> {{ $artisan->adress }}</p>
                <p><strong>ville :</strong> {{ $artisan->ville }}</p>
                <p><strong>telephone :</strong> {{ $artisan->tell }}</p>
                <p><strong>function :</strong> {{ $artisan->fonction }}</p>
                <!-- Ajoutez d'autres détails de l'artisan si nécessaire -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal pour afficher les règlements de chaque artisan -->
@foreach($artisans as $artisan)
<div class="modal fade" id="modalReglements{{ $artisan->id }}" tabindex="-1" aria-labelledby="modalReglements{{ $artisan->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalReglements{{ $artisan->id }}Label">Règlements de {{ $artisan->nom  }}---{{ $artisan->prenom  }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">  
                    <tbody>
                        @php
                        $totalMontant = 0; // Initialisez la variable pour le total
                    @endphp
                    @if($artisan->reglements)
                @foreach($artisan->reglements as $reglement)
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
                    <td colspan="3">Aucun règlement trouvé pour cet artisan.</td>
                </tr>
            @endif
                    </tbody>
                </table>

               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- modal pour ajouter un reglement de artisan --}}
<!-- Button trigger modal -->

  <div class="modal fade" id="addReglementModal" tabindex="-1" aria-labelledby="addReglementModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addReglementModalLabel">Ajouter un Règlement Artisan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('reglement_artisan.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="artisan_id">Artisan:</label>
              <select name="artisan_id" id="artisan_id" class="form-control">
                @foreach($artisans as $artisan)
                <option value="{{ $artisan->id }}">{{ $artisan->nom }} {{ $artisan->prenom }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="mode_id">Mode:</label>
              <select name="mode_id" id="mode_id" class="form-control">
                @foreach($modes as $mode)
                <option value="{{ $mode->id }}">{{ $mode->mode }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="date">Date:</label>
              <input type="date" name="date" id="date" class="form-control">
            </div>
            <div class="form-group">
              <label for="montant">Montant:</label>
              <input type="number" name="montant" id="montant" class="form-control" min="0" step="0.01">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Ajouter</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
{{-- modal pour ajouter --}}
<div class="modal fade" id="modalAjouterArtisan" tabindex="-1" aria-labelledby="modalAjouterArtisanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAjouterArtisanLabel">Ajouter un artisan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('artisan.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom">
                        @error('nom')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Ajoutez les autres champs avec des classes form-group et form-control -->
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom">
                        @error('prenom')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                     <input type="email" id="email" name="email" class="form-control">
                     @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" id="password" name="password" class="form-control">
        @error('password')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
        <label for="adresse" class="form-label">Adresse</label>
        <input type="text" id="adress" name="adress" class="form-control">
        @error('adress')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
        <div class="mb-3">
        <label for="ville" class="form-label">Ville</label>
        <input type="text" id="ville" name="ville" class="form-control">
        @error('ville')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
                     <div class="mb-3">
                        <label for="fonction" class="form-label">Fonction</label>
                    <input type="text"  class="form-control" id="fonction" name="fonction">
                    @error('fonction')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                        </div>
                    <!-- Ajoutez les autres champs de la même manière -->
                    <div class="mb-3">
                        <label for="tell" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" id="tell" name="tell">
                        @error('tell')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Ajouter l'artisan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- modal pour modifier --}}

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
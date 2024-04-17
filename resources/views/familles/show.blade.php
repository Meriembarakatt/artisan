<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Sous-famille</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/css/bootstrap.min.css" integrity="sha512-KyZXEAg3QhqLMpG8r+Knujsl7/1L_dstPt3HV5HzF6Gvk/e3s4Wz6iJgD/+ub2oU/+5s5V0G3jKJdX5B6/gkAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="modalFamilleLabel{{ $famille->id }}">Détails de la famille</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save data</button>
      </div>
    </div>
  </div>
</div>


<div class="container">
    <div class="row justicy-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4  class="text-center">php model</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Launch demo modal
                    </button>
                </div>
                <div class="card-body"></div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>
</html>













<!-- @extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])

<div class="container mt-10">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-4">Détails de la famille</h2>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                <strong>ID de la famille :</strong> {{ $famille->id }}
                            </div>
                            <div class="card-body">
                                <p><strong>Nom de la famille :</strong> {{ $famille->famille }}</p>
                                <!-- Ajoutez ici d'autres détails de la famille si nécessaire -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- Bouton pour ouvrir le modal -->
                    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modalFamille">
                        Afficher le modal
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalFamille" tabindex="-1" role="dialog" aria-labelledby="modalFamilleLabel" aria-hidden="true" data-backdrop="static">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalFamilleLabel">Détails de la famille</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>ID de la famille :</strong> {{ $famille->id }}</p>
                                    <p><strong>Nom de la famille :</strong> {{ $famille->famille }}</p>
                                    <!-- Ajoutez ici d'autres détails de la famille si nécessaire -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection -->

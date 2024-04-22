{{-- @extends('layouts.app')

@section('content') --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un règlement pour le client</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Inclure le CSS de Bootstrap -->
    <style>
        /* Style pour le formulaire */
        .form-group {
            margin-bottom: 20px; /* Espacement entre les groupes de champs */
        }

        /* Style pour les étiquettes */
        label {
            font-weight: bold; /* Texte en gras pour les étiquettes */
        }

        /* Style pour les boutons */
        .btn-primary {
            background-color: #007bff; /* Couleur de fond pour le bouton primaire */
            color: #fff; /* Couleur du texte pour le bouton primaire */
            border-color: #007bff; /* Couleur de la bordure pour le bouton primaire */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Couleur de fond au survol pour le bouton primaire */
            border-color: #0056b3; /* Couleur de la bordure au survol pour le bouton primaire */
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ajouter un règlement pour le client</div>

                <div class="card-body">
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
</div>
</body>
</html>
{{-- @endsection --}}

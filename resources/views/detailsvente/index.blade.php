@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="container ">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                
               <h1> <div class="card-header">Liste des   detail de  vente</div></h1>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- <div class="mb-3">
                        <a href="{{ route('detailsvente.create') }}" class="btn btn-success">Ajouter un detail de  vente</a>
                    </div>
                     --}}
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Article</th>
                                <th>Vente</th>
                                <th>Quantité</th>
                                <th>Prix</th>
                                <th>Montant</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $totalMontant = 0; // Initialisation de la variable de total
                            @endphp
                            @foreach ($detailsvente as $detail)
                                <tr>
                                    <td>{{ $detail->id }}</td>
                                    <td>{{ $detail->article->designation }}</td>
                                    <td>{{ $detail->vente->date }}</td>
                                    <td>{{ $detail->qte }}</td>
                                    <td>{{ $detail->prix }}</td>
                                    <td>{{ floatval($detail->qte) * floatval($detail->prix) }}</td>

                                    <td>
                                        <form action="{{ route('detailsvente.destroy', ['detailvente' => $detail->id]) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                                @php
                // Vérifier si les valeurs sont numériques avant de les multiplier
                if(is_numeric($detail->qte) && is_numeric($detail->prix)) {
                    $montant = intval($detail->qte) * floatval($detail->prix);
                    $totalMontant += $montant;
                   
                } else {
                    echo 'Valeurs non numériques';
                }
            @endphp
          @endforeach
          <!-- Affichage du total après la boucle -->
                <tr>
                    <td colspan="4"></td>
                    <td>Total Montant</td>
                    <td>{{ $totalMontant }}</td>
                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@extends('layouts.app')

@section('content')
<div class="container mt-10">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Liste des Règlements du artisan
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Montant</th>
                                <!-- Ajoutez d'autres colonnes si nécessaire -->
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalMontant = 0; // Initialisez la variable pour le total
                            @endphp
                            @foreach($reglements as $reglement)
                                <tr>
                                    <td>{{ $reglement->id }}</td>
                                    <td>{{ $reglement->date }}</td>
                                    <td>{{ $reglement->montant }}</td>
                                    <!-- Ajoutez d'autres données du règlement si nécessaire -->
                                </tr>
                                @php
                                    $totalMontant += $reglement->montant; // Accumulez le montant dans le total
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <div class="total-montant">Total : {{ $totalMontant }}</div> <!-- Affichez le total après la boucle -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-10">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Liste des Règlements du Client
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
                            @foreach($reglements as $reglement)
                                <tr>
                                    <td>{{ $reglement->id }}</td>
                                    <td>{{ $reglement->date }}</td>
                                    <td>{{ $reglement->montant }}</td>
                                    <!-- Ajoutez d'autres données du règlement si nécessaire -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

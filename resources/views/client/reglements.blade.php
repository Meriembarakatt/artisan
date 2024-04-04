<h5>Règlements de {{ $client->nom }} {{ $client->prenom }}</h5>
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
        @foreach($client->reglements as $reglement)
            <tr>
                <td>{{ $reglement->id }}</td>
                <td>{{ $reglement->date }}</td>
                <td>{{ $reglement->montant }}</td>
                <!-- Ajoutez d'autres données du règlement si nécessaire -->
            </tr>
        @endforeach
    </tbody>
</table>

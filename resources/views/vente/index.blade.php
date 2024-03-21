{{-- resources/views/ventes/index.blade.php --}}

<a href="{{ route('vente.create') }}">Ajouter la client </a>
<div class="container">
    <h1>Liste des Ventes</h1>
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Client</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventes as $vente)
                <tr>
                    <td>{{ $vente->id }}</td>
                    <td>{{ $vente->date }}</td>
                    <td>{{ $vente->client->nom }}</td>
                   
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


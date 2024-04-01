
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h1>Liste des Ventes</h1>
    <a href="{{ route('vente.create') }}" class="btn btn-primary mb-3">Ajouter une Vente</a>

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
            @foreach($ventes as $vente)
            <tr>
                <td>{{ $vente->id }}</td>
                <td>{{ $vente->date }}</td>
                <td>{{ $vente->client->nom }}</td>
                <td>
                    <a href="{{ route('ventes.show', $vente->id) }}" class="btn btn-info">Voir</a>
                    <a href="{{ route('ventes.edit', $vente->id) }}" class="btn btn-primary">Modifier</a>
                    <form action="{{ route('ventes.destroy', $vente->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette vente ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

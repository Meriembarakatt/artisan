<div class="container">
    <a href="{{ route('bonreseption.create') }}" class="btn btn-primary mb-3">Ajouter un Bon de Réception</a>
    <h1>Liste des Bons de Réception</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Artisan</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bonreceptions as $bonreception)
                <tr>
                    <td>{{ $bonreception->id }}</td>
                    <td>{{ $bonreception->date }}</td>
                    <td>{{ $bonreception->artisan->nom }}</td>
                    <td>
                    <form action="{{ route('bonreseption.destroy', ['bonreception' => $bonreception->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form> </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

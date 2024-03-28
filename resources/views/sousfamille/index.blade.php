<div class="container">
    <h2>Liste des Sous-familles</h2>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <a href="{{ route('sousfamille.create') }}" class="btn btn-primary mb-2">Ajouter une sous-famille</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom de la sous-famille</th>
                <th>Famille</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sousFamilles as $sousFamille)
            <tr>
                <td>{{ $sousFamille->id }}</td>
                <td>{{ $sousFamille->name }}</td>
                <td>{{ $sousFamille->famille->famille }}</td>
                <td>
                    <form action="{{ route('sousfamille.edit', $sousFamille->id) }}" method="get" style="display: inline;">
                        <button type="submit">Éditer</button>
                    </form>
                    <form action="{{ route('sousfamille.destroy', $sousFamille->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Supprimer</button>
                    </form>
                    <form action="{{ route('sousfamille.show', $sousFamille->id) }}" method="get" style="display: inline;">
                        @csrf
                        <button type="submit">Détails</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

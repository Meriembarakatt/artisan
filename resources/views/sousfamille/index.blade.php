
<div class="container">
    <h2>Liste des sous-Familles</h2>
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
                    <form action="{{ route('sousfamille.edit', $sousFamille->id) }}" method="GET" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">Éditer</button>
                    </form>
                    <form action="{{ route('sousfamille.destroy', $sousFamille->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette sous-famille ?')">Supprimer</button>
                    </form>
                    <form action="{{ route('sousfamille.show', $sousFamille->id) }}" method="GET" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-info">Détails</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


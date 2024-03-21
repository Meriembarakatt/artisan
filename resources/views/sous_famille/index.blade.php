<a href="{{ route('sous-familles.create') }}">Ajouter la famille </a>
    <div class="container">
        <h1>Liste des Sous-Familles</h1>
        Ajouter une Sous-Famille
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Famille</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sousFamilles as $sousFamille)
                    <tr>
                        <td>{{ $sousFamille->id }}</td>
                        <td>{{ $sousFamille->name }}</td>
                        <td>{{ $sousFamille->famille->famille }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


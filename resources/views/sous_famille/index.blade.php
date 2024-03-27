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
                        <td>
                        <form action="{{ route('sous-familles.destroy', ['sousFamille' => $sousFamille->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <!-- Le reste de votre formulaire pour la suppression -->
                            <button type="submit">Supprimer</button>
                        </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


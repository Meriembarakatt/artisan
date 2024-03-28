<a href="{{ route('familles.create') }}">Ajouter la famille</a>

<table>
    <thead>
        <tr>
            <th>Famille</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($familles as $famille)
        <tr>
            <td>{{ $famille->famille }}</td>
            <td>
                <form action="{{ route('familles.edit', $famille->id) }}" method="get" style="display: inline;">
                    <button type="submit">Éditer</button>
                </form>
                <form action="{{ route('familles.destroy', $famille->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
                <form action="{{ route('familles.show', $famille->id) }}" method="get" style="display: inline;">
                    @csrf
                    <button type="submit">Détails</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

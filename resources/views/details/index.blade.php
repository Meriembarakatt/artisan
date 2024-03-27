<a href="{{ route('details.create') }}">Ajouter la detail</a>
    <div class="container">
        <h1>Liste des Détails de Bon de Réception</h1>
       
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Article</th>
                    <th>Bon de Réception</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detail__brs as $detail)
                    <tr>
                        <td>{{ $detail->id }}</td>
                        <td>{{ $detail->article->designation }}</td>
                        <td>{{ $detail->bonreception->id }}</td>
                        <td>{{ $detail->qte }}</td>
                        <td>{{ $detail->prix }}</td>
                       <td>
                       <form action="{{ route('details.destroy', ['detail' => $detail->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                       </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


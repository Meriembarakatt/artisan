<a href="{{ route('article.create') }}">Ajouter un article</a>
<div class="container">
    <h1>Liste des Articles</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Designation</th>
                <th>Prix HT</th>
                <th>Quantité</th>
                <th>Stock</th>
                <th>Photo</th>
                <th>Famille</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->designation }}</td>
                    <td>{{ $article->prix_ht }}</td>
                    <td>{{ $article->qte }}</td>
                    <td>{{ $article->stock }}</td>
                    <td>
                        @if ($article->photo)
                            <img src="{{ asset('storage/' . $article->photo) }}" alt="{{ $article->designation }}" style="max-width: 100px;">
                        @else
                            Pas de photo
                        @endif
                    </td>
                    <td>{{ $article->sousFamille->name }}</td>
                   
                    <td>
                       
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

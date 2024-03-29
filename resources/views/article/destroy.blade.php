<td>
    <!-- Bouton pour supprimer l'article -->
    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article?')">Supprimer</button>
    </form>
</td>

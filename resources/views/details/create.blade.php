

<div class="container">
    <h1>Ajouter un Détail de Bon de Réception</h1>
    <form action="{{ route('details.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="article_id">Article</label>
            <select class="form-control" id="article_id" name="article_id" required>
                @foreach ($articles as $article)
                    <option value="{{ $article->id }}">{{ $article->designation }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="br_id">Bon de Réception</label>
            <select class="form-control" id="br_id" name="br_id" required>
                @foreach ($bonreceptions as $bonreception)
                    <option value="{{ $bonreception->id }}">{{ $bonreception->date }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="qte">Quantité</label>
            <input type="text" class="form-control" id="qte" name="qte" required>
        </div>
        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="text" class="form-control" id="prix" name="prix" required>
        </div>
     

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>


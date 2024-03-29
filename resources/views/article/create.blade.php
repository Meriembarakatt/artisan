<div class="container">
    <h1>Ajouter un nouvel article</h1>
    <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="designation">Désignation</label>
            <input type="text" class="form-control" id="designation" name="designation">
            @error('designation')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="prix_ht">Prix HT</label>
            <input type="text" class="form-control" id="prix_ht" name="prix_ht" required>
        </div>
        <div class="form-group">
            <label for="qte">Quantité</label>
            <input type="text" class="form-control" id="qte" name="qte" required>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="text" class="form-control" id="stock" name="stock" required>
        </div>
        <div class="form-group">
            <label for="sous_famille_id">Sous-Famille</label>
            <select class="form-control" id="sous_famille_id" name="sous_famille_id" required>
                @foreach ($sousFamilles as $sousFamille)
                    <option value="{{$sousFamille->id }}">{{ $sousFamille->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" class="form-control-file" id="photo" name="photo">
        </div>
        
        <!-- Ajoutez d'autres champs si nécessaire -->

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

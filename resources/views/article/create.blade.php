

        <div class="form-group">
            <label for="prix_ht">Prix HT</label>
            <input type="text" class="form-control" id="prix_ht" name="prix_ht" >
        </div>
        <div class="form-group">
            <label for="qte">Quantité</label>
            <input type="text" class="form-control" id="qte" name="qte" >
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="text" class="form-control" id="stock" name="stock" >
        </div>
        <div class="form-group">
            <label for="sous_famille_id">Sous-Famille</label>
            <select class="form-control" id="sous_famille_id" name="sous_famille_id" >
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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Créer un nouvel Article</div>
    
                    <div class="card-body">
                        <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="designation">Désignation:</label>
                                <input type="text" name="designation" class="form-control" id="designation" required>
                            </div>
                            <div class="form-group">
                                <label for="prix_ht">Prix HT:</label>
                                <input type="number" name="prix_ht" class="form-control" id="prix_ht" required>
                            </div>
                            <div class="form-group">
                                <label for="qte">Quantité:</label>
                                <input type="number" name="qte" class="form-control" id="qte" required>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock:</label>
                                <input type="number" name="stock" class="form-control" id="stock" required>
                            </div>
                            <div class="form-group">
                                <label for="sousfamille_id">Sous-famille:</label>
                                <select name="sousfamille_id" class="form-control" id="sousfamille_id" required>
                                    @foreach ($sousFamilles as $sousFamille)
                                        <option value="{{ $sousFamille->id }}">{{ $sousFamille->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Image:</label>
                                <input type="file" name="image" class="form-control-file" id="image">
                            </div>
                            <button type="submit" class="btn btn-primary">Créer l'Article</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



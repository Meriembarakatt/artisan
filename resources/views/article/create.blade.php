
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
<style>
    /* Style pour le formulaire de création d'article */
    .card {
        margin-top: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #007bff;
        color: #fff;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .card-body {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 5px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 5px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .invalid-feedback {
        display: block;
        color: #dc3545;
        margin-top: 5px;
    }

    /* Style pour la zone de saisie de fichier */
    .form-control-file {
        border-radius: 5px;
    }
</style>
        
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
                                    <input type="text" name="designation" class="form-control" id="designation" >
                                    @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="prix_ht">Prix HT:</label>
                                    <input type="number" name="prix_ht" class="form-control" id="prix_ht" >
                                    @error('prix_ht')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="qte">Quantité:</label>
                                    <input type="number" name="qte" class="form-control @error('qte') is-invalid @enderror" id="qte">
                                    @error('qte')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock:</label>
                                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" id="stock" >
                                    @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sousfamille_id">Sous-famille:</label>
                                    <select name="sousfamille_id" class="form-control @error('sousfamille_id') is-invalid @enderror" id="sousfamille_id" >
                                        <option value="">Sélectionnez une sous-famille</option>
                                        @foreach ($sousFamilles as $sousFamille)
                                        <option value="{{ $sousFamille->id }}">{{ $sousFamille->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('sousfamille_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="image">Image:</label>
                                    <input type="file" name="image" class="form-control-file" id="image">
                                </div>
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                                <a href="{{ route('article.index') }}" class="btn btn-secondary">Annuler</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    
    
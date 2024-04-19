<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Article</title>
    <!-- Intégration de Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styles personnalisés */
        .card-header {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 8px;
        }

        .btn-primary {
            background-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modifier l'Article</div>

                    <div class="card-body">
                        <form action="{{ route('article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="designation">Désignation:</label>
                                <input type="text" name="designation" class="form-control" id="designation" value="{{ $article->designation }}" required>
                            </div>
                            <div class="form-group">
                                <label for="prix_ht">Prix HT:</label>
                                <input type="number" name="prix_ht" class="form-control" id="prix_ht" value="{{ $article->prix_ht }}" required>
                            </div>
                            <div class="form-group">
                                <label for="qte">Quantité:</label>
                                <input type="number" name="qte" class="form-control" id="qte" value="{{ $article->qte }}" required>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock:</label>
                                <input type="number" name="stock" class="form-control" id="stock" value="{{ $article->stock }}" required>
                            </div>
                            <div class="form-group">
                                <label for="sousfamille_id">Sous-famille:</label>
                                <select name="sousfamille_id" class="form-control" id="sousfamille_id" required>
                                    @foreach ($sousFamilles as $sousFamille)
                                        <option value="{{ $sousFamille->id }}" {{ $article->sousfamille_id == $sousFamille->id ? 'selected' : '' }}>{{ $sousFamille->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Image:</label>
                                <input type="file" name="image" class="form-control-file" id="image">
                            </div>
                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                            <button><a href="{{ route('article.index') }}" class="btn btn-primary">Annuler</a></button>
                       
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la Famille</title>
    <!-- Intégration de Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
       

     
  
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Modifier la Famille</div>

                    <div class="card-body">
                        <form action="{{ route('familles.update', $famille->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="famille">Nom de la Famille:</label>
                                <input type="text" class="form-control" id="famille" name="famille" value="{{ $famille->famille }}">
                            </div>
                            <!-- Ajoutez ici d'autres champs pour la famille si nécessaire -->
                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                            <a href="{{ route('familles.index') }}" class="btn btn-primary">Annuler</a>
                       
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

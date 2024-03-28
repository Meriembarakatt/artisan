
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


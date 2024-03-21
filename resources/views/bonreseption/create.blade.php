<div class="container">
    <h1>Ajouter un Bon de Réception</h1>
    <form action="{{ route('bonreseption.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="artisan_id">Artisan</label>
            <select class="form-control" id="artisan_id" name="artisan_id" required>
                @foreach ( $artisans as $artisan)
                    <option value="{{ $artisan->id }}">{{ $artisan->nom }}</option>
                @endforeach
            </select>
        </div>
       
        <!-- Ajoutez d'autres champs si nécessaire -->

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

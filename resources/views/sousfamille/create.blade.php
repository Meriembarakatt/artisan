
<div class="container">
    <h2>Ajouter une Sous-famille</h2>
    <form method="POST" action="{{ route('sousfamille.store') }}">
        @csrf
        <div class="form-group">
            <label for="famille_id">Famille :</label>
            <select name="famille_id" id="famille_id" class="form-control">
                @foreach($familles as $famille)
                    <option value="{{ $famille->id }}">{{ $famille->famille }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Nom de la Sous-famille :</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter la Sous-famille</button>
    </form>
</div>


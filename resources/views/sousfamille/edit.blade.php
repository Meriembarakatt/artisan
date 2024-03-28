
<div class="container">
    <h2>Modifier une Sous-famille</h2>
    <form method="POST" action="{{ route('sousfamille.update', $sousFamille->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="famille_id">Famille :</label>
            <select name="famille_id" id="famille_id" class="form-control">
                @foreach($familles as $famille)
                    <option value="{{ $famille->id }}" {{ $sousFamille->famille_id == $famille->id ? 'selected' : '' }}>{{ $famille->famille }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Nom de la Sous-famille :</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $sousFamille->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
</div>


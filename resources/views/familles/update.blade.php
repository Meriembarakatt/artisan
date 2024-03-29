
<div class="container">
    <h2>Modifier une sous-famille</h2>
    <form method="POST" action="{{ route('sous-familles.update', $sousFamille->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="famille_id">Famille :</label>
            <select name="famille_id" id="famille_id" class="form-control">
                @foreach($familles as $famille)
                    <option value="{{ $famille->id }}" {{ $famille->id === $sousFamille->famille_id ? 'selected' : '' }}>
                        {{ $famille->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Nom de la sous-famille :</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $sousFamille->name }}">
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
</div>


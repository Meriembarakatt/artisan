<div class="container">
    <h1>Ajouter une Sous-Famille</h1>
    <form action="{{ route('sous-familles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="famille_id">Famille</label>
            <select class="form-control" id="famille_id" name="famille_id" required>
                @foreach ($familles as $famille)
                    <option value="{{ $famille->id }}">{{ $famille->famille }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Name_sous_famille</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
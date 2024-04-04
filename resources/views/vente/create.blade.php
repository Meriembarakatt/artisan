{{-- resources/views/ventes/create.blade.php --}}

<div class="container">
    <h1>Ajouter une Vente</h1>
    <form action="{{ route('vente.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="date">Date vente</label>
            <input type="date" class="form-control" id="date" name="date" required onchange="updateDetailDate()">
            <!-- Ajoutez l'événement onchange pour appeler la fonction JavaScript lorsqu'une date est sélectionnée -->
        </div>
        <div class="form-group">
            <label for="client_id">Client</label>
            <select class="form-control" id="client_id" name="client_id" required>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->nom }}</option>
                @endforeach
            </select>
        </div>
        <!-- Ajoutez d'autres champs si nécessaire -->

        <button type="submit" class="btn btn-primary">Ajouter Vente</button>
    </form>
</div>


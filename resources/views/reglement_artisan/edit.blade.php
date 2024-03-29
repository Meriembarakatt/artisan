
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Modifier le Règlement Artisan
                    </div>
                    <div class="card-body">
                        <form action="{{ route('reglement_artisan.update', $reglementArtisan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="artisan_id">Artisan:</label>
                                <select name="artisan_id" id="artisan_id" class="form-control">
                                    @foreach($artisans as $artisan)
                                        <option value="{{ $artisan->id }}" {{ $reglementArtisan->artisan_id == $artisan->id ? 'selected' : '' }}>
                                            {{ $artisan->nom }} {{ $artisan->prenom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="mode_id">Mode:</label>
                                <select name="mode_id" id="mode_id" class="form-control">
                                    @foreach($modes as $mode)
                                        <option value="{{ $mode->id }}" {{ $reglementArtisan->mode_id == $mode->id ? 'selected' : '' }}>
                                            {{ $mode->mode }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date">Date:</label>
                                <input type="date" name="date" id="date" class="form-control" value="{{ $reglementArtisan->date }}">
                            </div>
                            <div class="form-group">
                                <label for="montant">Montant:</label>
                                <input type="number" name="montant" id="montant" class="form-control" min="0" step="0.01" value="{{ $reglementArtisan->montant }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                            <a href="{{ route('reglement_artisan.index') }}" class="btn btn-secondary">Retour</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


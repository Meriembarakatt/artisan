
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Détails du Règlement Artisan
                    </div>
                    <div class="card-body">
                        <div>
                            <strong>Artisan:</strong> {{ $reglementArtisan->artisan->nom }} {{ $reglementArtisan->artisan->prenom }}
                        </div>
                        <div>
                            <strong>Mode:</strong> {{ $reglementArtisan->mode->mode }}
                        </div>
                        <div>
                            <strong>Date:</strong> {{ $reglementArtisan->date }}
                        </div>
                        <div>
                            <strong>Montant:</strong> {{ $reglementArtisan->montant }}
                        </div>
                        <a href="{{ route('reglement_artisan.index') }}" class="btn btn-secondary">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


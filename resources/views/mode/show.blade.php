
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Détails du Mode
                    </div>
                    <div class="card-body">
                        <p><strong>ID:</strong> {{ $mode->id }}</p>
                        <p><strong>Mode:</strong> {{ $mode->mode }}</p>
                        <a href="{{ route('modes.index') }}" class="btn btn-secondary">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

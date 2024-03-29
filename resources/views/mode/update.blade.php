
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Modifier le Mode
                    </div>
                    <div class="card-body">
                        <form action="{{ route('modes.update', $mode->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="mode">Mode</label>
                                <input type="text" name="mode" id="mode" class="form-control" value="{{ $mode->mode }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                            <a href="{{ route('modes.index') }}" class="btn btn-secondary">Retour</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


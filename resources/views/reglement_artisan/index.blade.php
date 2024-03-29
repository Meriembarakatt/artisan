
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Liste des Règlements Artisans
                        <a href="{{ route('reglement_artisan.create') }}" class="btn btn-primary float-right">Ajouter un Règlement Artisan</a>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Artisan</th>
                                    <th>Mode</th>
                                    <th>Date</th>
                                    <th>Montant</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($regArtisans as $regArtisan)
                                    <tr>
                                        <td>{{ $regArtisan->id }}</td>
                                        <td>{{ $regArtisan->artisan->nom }} {{ $regArtisan->artisan->prenom }}</td>
                                        <td>{{ $regArtisan->mode->mode }}</td>
                                        <td>{{ $regArtisan->date }}</td>
                                        <td>{{ $regArtisan->montant }}</td>
                                        <td>
                                            <form action="{{ route('reglement_artisan.edit', $regArtisan->id) }}" method="POST" style="display: inline-block;>
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce règlement artisan ?')">Supprimer</button>
                                            </form>
                                            <form action="{{ route('reglement_artisan.show', $regArtisan->id) }}" method="POST" style="display: inline-block;>
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce règlement artisan ?')">Supprimer</button>
                                            </form>
                                            <form action="{{ route('reglement_artisan.destroy',$regArtisan->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce règlement artisan ?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


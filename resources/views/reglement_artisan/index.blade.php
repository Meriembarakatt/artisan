<table class="table" border=2>
        <thead>
            <tr>
                <th>ID</th>
                <th>date</th>
                <th>montant artisan</th>
                <th>Artisan</th>
                <th>Mode</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($regArtisans as $regArtisan)
                <tr>
                    <td>{{ $regArtisan->id }}</td>
                    <td>{{ optional($regArtisan->artisans)->prenom }}</td>
                    <td>{{ $regArtisan->mode->mode }}</td>
                    <td>{{ $regArtisan-> montant}}</td>
                    <td>{{ $regArtisan->date }}</td>
                    <td>
                     
                </td>
                  
                </tr>
            @endforeach
        </tbody>
    </table>
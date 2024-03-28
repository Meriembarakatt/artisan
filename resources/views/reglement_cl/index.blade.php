 <table class="table" border=2>
        <thead>
            <tr>
                <th>ID</th>
                <th>client</th>
                <th>mode</th>
                <th>montant</th>
                <th>date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reglementCls as $reglementCl)
                <tr>
                    <td>{{ $reglementCl->id }}</td>
                    <td>{{ $reglementCl->client->prenom }}</td>
                    <td>{{ $reglementCl->mode->mode }}</td>
                    <td>{{ $reglementCl-> montant}}</td>
                    <td>{{ $reglementCl->date }}</td>
                    <td>
                     
                </td>
                  
                </tr>
            @endforeach
        </tbody>
    </table>
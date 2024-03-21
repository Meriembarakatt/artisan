<a href="{{ route('client.create') }}">Ajouter la client </a>
<h1>Liste des client</h1>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Adresse</th>
            <th>Ville</th>
            <th>Téléphone</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($clients as $client)
        <tr>
            <td>{{ $client->nom }}</td>
            <td>{{$client->prenom }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ $client->adress }}</td>
            <td>{{ $client->ville }}</td>
            <td>{{ $client->tell }}</td>
           
        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('familles.create') }}">Ajouter la famille </a>
<table>
        <thead>
            <tr>
                <th>famille</th> 
            </tr>
        </thead>
        <tbody>
            @foreach ($familles as $famille)
            <tr>
               
                <td>{{ $famille->famille }}</td>  
            </tr>
            @endforeach
        </tbody>
    </table>
<table class="table" border=2>
        <thead>
            <tr>
                <th>ID</th>
                <th>mode</th>
               
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($modes as $mode)
                <tr>
                    <td>{{ $mode->id }}</td>
                    <td>{{ $mode->mode }}</td>
                    <td>
                     
                </td>
                  
                </tr>
            @endforeach
        </tbody>
    </table>
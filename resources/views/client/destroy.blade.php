use App\Models\Client;

public function destroy(Client $client)
{
    $client->delete();
    return redirect()->route('client.index')->with('success', 'Articolo eliminato con successo!');
}

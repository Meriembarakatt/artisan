use App\Models\Famille;

public function destroy(Famille $famille)
{
    $famille->delete();
    return redirect()->route('familles.index')->with('success', 'Articolo eliminato con successo!');
}

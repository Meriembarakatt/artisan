use App\Models\Bonreseption;

public function destroy(bonreception $bonreception)
{
    $bonreception->delete();
    return redirect()->route('bonreseption.index')->with('success', 'Articolo eliminato con successo!');
}

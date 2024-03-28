use App\Models\SousFamille;

public function destroy(SousFamille $sousFamille)
{
    $sousFamille->delete();
    return redirect()->route('sousfamille.index')->with('success', 'Articolo eliminato con successo!');
}

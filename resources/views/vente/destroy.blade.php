use App\Models\Vente;

public function destroy(vente $vente)
{
    $vente->delete();
    return redirect()->route('vente.index')->with('success', 'Articolo eliminato con successo!');
}

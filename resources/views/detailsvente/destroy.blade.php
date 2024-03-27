use App\Models\Detailvente;

public function destroy(Detailvente $detailvente)
{
    $detailvente->delete();
    return redirect()->route('detailsvente.index')->with('success', 'Articolo eliminato con successo!');
}

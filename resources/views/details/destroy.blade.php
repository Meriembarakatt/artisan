use App\Models\DetailBr;

public function destroy(DetailBr $DetailBr)
{
    $DetailBr->delete();

    return redirect()->route('details.index')->with('success', 'Articolo eliminato con successo!');

}

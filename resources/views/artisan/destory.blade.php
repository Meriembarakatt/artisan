use App\Models\Artisan;

public function destroy(Artisan $artisan)
{
    $artisan->delete();
    return redirect()->route('artisan.index')->with('success', 'Articolo eliminato con successo!');
}

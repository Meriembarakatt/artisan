<?php

namespace App\Http\Controllers;

use App\Models\Artisan;
use App\Models\Mode;
use App\Models\reglementArtisan;
use Illuminate\Http\Request;

class ReglementArtisanController extends Controller
{
    public function index()
    {
       
        $regArtisans=reglementArtisan::orderBy('id', 'desc')->paginate(10);
        $artisans=Artisan::orderBy('id', 'desc')->paginate(10);
        $modes=Mode::orderBy('id', 'desc')->paginate(10);
        return view('reglement_artisan.index',compact('regArtisans','artisans','modes'));
   
    
    }

    public function create()
    {
        $artisans = Artisan::all();
        $modes = Mode::all();
        return view('reglement_artisan.create', compact('artisans', 'modes'));
    }

    public function show(reglementArtisan $reglementArtisan)
    {
        return view('reglement_artisan.show', compact('reglementArtisan'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'artisan_id' => 'required|exists:artisans,id',
            'mode_id' => 'required|exists:modes,id',
            'date' => 'required|date',
            'montant' => 'required|numeric|min:0',
        ]);

        reglementArtisan::create($validatedData);

        return redirect()->route('reglement_artisan.index')->with('success', 'Reglement artisan ajouté avec succès.');
    }

    public function edit(reglementArtisan $reglementArtisan)
    {
        $artisans = Artisan::all();
        $modes = Mode::all();
        return view('reglement_artisan.edit', compact('reglementArtisan', 'artisans', 'modes'));
    }

    public function update(Request $request, reglementArtisan $reglementArtisan)
    {
        $request->validate([
            'artisan_id' => 'required|exists:artisans,id',
            'mode_id' => 'required|exists:modes,id',
            'date' => 'required|date',
            'montant' => 'required|numeric|min:0',
        ]);

        $reglementArtisan->update([
            'artisan_id' => $request->artisan_id,
            'mode_id' => $request->mode_id,
            'date' => $request->date,
            'montant' => $request->montant,
        ]);

        return redirect()->route('reglement_artisan.index')->with('success', 'Reglement artisan mis à jour avec succès.');
    }

    public function destroy(reglementArtisan $reglementArtisan)
    {
        $reglementArtisan->delete();

        return redirect()->route('reglement_artisan.index')->with('success', 'Reglement artisan supprimé avec succès.');
    }
}

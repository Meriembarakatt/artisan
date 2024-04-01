<?php

namespace App\Http\Controllers;

use App\Models\SousFamille;
use Illuminate\Http\Request;
use App\Models\Famille;

class SousFamilleController extends Controller
{
    public function index()
    {
        $sousFamilles = SousFamille::all();
        return view('sousfamille.index', compact('sousFamilles'));
    }

    public function create()
    {
        $familles = Famille::all();
        return view('sousfamille.create', compact('familles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'famille_id' => 'required|exists:familles,id',
            'name' => 'required|max:255',
        ]);

        SousFamille::create($validatedData);

        return redirect('/sousfamilles')->with('success', 'Sous-famille ajoutée avec succès');
    }

    public function show(SousFamille $sousFamille)
    {
        $famille = $sousFamille->famille;
        return view('sousfamille.show', compact('sousFamille', 'famille'));
    }

    public function edit(SousFamille $sousFamille)
    {
        $familles = Famille::all();
        return view('sousfamille.edit', compact('sousFamille', 'familles'));
    }

    public function update(Request $request, SousFamille $sousFamille)
    {
        $validatedData = $request->validate([
            'famille_id' => 'required|exists:familles,id',
            'name' => 'required|max:255',
        ]);

        $sousFamille->update($validatedData);

        return redirect('/sousfamilles')->with('success', 'Sous-famille mise à jour avec succès');
    }

    public function destroy(SousFamille $sousFamille)
    {
        $sousFamille->delete();
        return redirect()->route('sousfamille.index')->with('success', 'Sous-famille supprimée avec succès');
    }
}

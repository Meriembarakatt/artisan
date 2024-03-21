<?php

namespace App\Http\Controllers;

use App\Models\Bonreseption;
use App\Models\Artisan;
use Illuminate\Http\Request;

class BonreseptionController extends Controller
{
    public function index()
    {
        $bonreceptions = Bonreseption::with('artisan')->get();
        return view('bonreseption.index', compact('bonreceptions'));
    }

    public function create()
    {
        $artisans = Artisan::all(); 
        return view('bonreseption.create', compact('artisans'));
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'artisan_id' => 'required|exists:artisans,id',
        ]);

        Bonreseption::create($validatedData);

        return redirect('/bonreseption')->with('success', 'Bon de réception ajouté avec succès');
    }

    public function show(Bonreseption $bonreception)
    {
        return view('bonreseption.show', compact('bonreception'));
    }

    public function edit(Bonreseption $bonreception)
    {
        return view('bonreseption.edit', compact('bonreception'));
    }

    public function update(Request $request, Bonreseption $bonreception)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'artisan_id' => 'required|exists:artisans,id',
        ]);

        $bonreception->update($validatedData);

        return redirect('/bonreseption')->with('success', 'Bon de réception mis à jour avec succès');
    }

    public function destroy(Bonreseption $bonreception)
    {
        $bonreception->delete();

        return redirect('/bonreseption')->with('success', 'Bon de réception supprimé avec succès');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Bonreseption;
use App\Models\Artisan;
use App\Models\article;
use App\Models\DetailBr;
use Illuminate\Http\Request;

class BonreseptionController extends Controller
{
    public function index()
    {
        $bonreceptions = Bonreseption::orderBy('id', 'desc')->paginate(10);
        return view('bonreseption.index', compact('bonreceptions'));
    }

    public function create()
    {  $bonreceptions = Bonreseption::all(); 
         $articles = article::all();
        $artisans = Artisan::all();
        return view('bonreseption.create', compact( 'bonreceptions','artisans','articles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'artisan_id' => 'required|exists:artisans,id',
            'Bon_reception' => 'required|array',
            'Bon_reception.*.article_id' => 'required|exists:articles,id',
            'Bon_reception.*.qte' => 'required|integer|min:1',
            'Bon_reception.*.prix' => 'required|numeric|min:0',
        ]);
    
        try {
            // Début de la transaction
            \DB::beginTransaction();
    
            // Enregistrement du bon de réception
            $bonReception = new BonReception();
            $bonReception->date = $validatedData['date'];
            $bonReception->artisan_id = $validatedData['artisan_id'];
            $bonReception->save();
    
            // Enregistrement des détails du bon de réception
            $ventesData = $validatedData['Bon_reception'];
            $details = [];
            foreach ($ventesData as $detail) {
                $details[] = new DetailBr([
                    'article_id' => $detail['article_id'],
                    'br_id' => $bonReception->id,
                    'qte' => $detail['qte'],
                    'prix' => $detail['prix'],
                ]);
            }
            $bonReception->details()->saveMany($details);
    
            // Validation et confirmation de la transaction
            \DB::commit();
    
            return redirect('/bonreseption')->with('success', 'Détails du bon de réception ajoutés avec succès');
        } catch (\Exception $e) {
            // En cas d'erreur, annulation de la transaction
            \DB::rollBack();
    
            return back()->withInput()->withErrors(['error' => 'Une erreur est survenue lors de l\'enregistrement. Veuillez réessayer.']);
        }
    }
    

    public function show(Bonreseption $bonreception)
    {
        return view('bonreseption.show', compact('bonreception'));
    }

    public function edit(Bonreseption $bonreception)
{
    $artisans = Artisan::all();
    return view('bonreseption.edit', compact('bonreception', 'artisans'));
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
        return redirect()->route('bonreseption.index')->with('success', 'Bon de réception supprimé avec succès!');
    }
}

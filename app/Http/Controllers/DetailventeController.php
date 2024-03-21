<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detailvente;
use App\Models\Vente;
use App\Models\article;

class DetailventeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detailsvente = Detailvente::all();
        return view('detailsvente.index', compact('detailsvente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles = article::all();
        $ventes = Vente::all();
        return view('detailsvente.create', compact('articles', 'ventes'));
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'vente_id' => 'required|exists:ventes,id',
            'qte' => 'required',
            'prix' => 'required',
        ]);

        Detailvente::create($validatedData);

        return redirect('/details')->with('success', 'Détail de vente ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Detailvente  $detailvente
     * @return \Illuminate\Http\Response
     */
    public function show(Detailvente $detailvente)
    {
        return view('details.show', compact('detailvente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detailvente  $detailvente
     * @return \Illuminate\Http\Response
     */
    public function edit(Detailvente $detailvente)
    {
        return view('details.edit', compact('detailvente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detailvente  $detailvente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detailvente $detailvente)
    {
        $validatedData = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'vente_id' => 'required|exists:ventes,id',
            'qte' => 'required',
            'prix' => 'required',
        ]);

        $detailvente->update($validatedData);

        return redirect('/details')->with('success', 'Détail de vente mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detailvente  $detailvente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detailvente $detailvente)
    {
        $detailvente->delete();

        return redirect('/details')->with('success', 'Détail de vente supprimé avec succès');
    }
}

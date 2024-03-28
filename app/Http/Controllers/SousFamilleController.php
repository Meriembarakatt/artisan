<?php

namespace App\Http\Controllers;

use App\Models\SousFamille;
use Illuminate\Http\Request;
use App\Models\Famille;
class SousFamilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sousFamilles = SousFamille::all();
        return view('sousfamille.index', compact('sousFamilles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $familles = Famille::all();
        return view('sousfamille.create', compact('familles'));
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
            'famille_id' => 'required|exists:familles,id',
            'name' => 'required|max:255',
        ]);

        SousFamille::create($validatedData);

        return redirect('/sousfamilles')->with('success', 'sousfamille ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SousFamille  $sousFamille
     * @return \Illuminate\Http\Response
     */
    public function show(SousFamille $sousFamille)
{
    $famille = $sousFamille->famille;
    return view('sousfamille.show', compact('sousFamille', 'famille'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SousFamille  $sousFamille
     * @return \Illuminate\Http\Response
     */
    public function edit(SousFamille $sousFamille)
    {
        $familles = Famille::all();
        return view('sousfamille.edit', compact('sousFamille', 'familles'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SousFamille  $sousFamille
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SousFamille $sousFamille)
    {
        $validatedData = $request->validate([
            'famille_id' => 'required|exists:familles,id',
            'name' => 'required|max:255',
        ]);

        $sousFamille->update($validatedData);

        return redirect('/sousfamilles')->with('success', 'Sous-famille mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SousFamille  $sousFamille
     * @return \Illuminate\Http\Response
     */
    public function destroy(SousFamille $sousFamille)
    {
        $sousFamille->delete();
        return redirect()->route('sousfamille.index');
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Famille;
use Illuminate\Http\Request;

class FamilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $familles=Famille::all();
        return view('familles.index', ['familles' => $familles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('familles.create');
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
            'famille' => 'required|max:255',
            // Ajoutez ici les autres règles de validation pour les autres champs
        ]);
        Famille::create($request->all()) ;
            return redirect('/familles')->with('succes','familles Ajoute avec succes');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\famille  $famille
     * @return \Illuminate\Http\Response
     */
    public function show(famille $famille)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\famille  $famille
     * @return \Illuminate\Http\Response
     */
    public function edit(famille $famille)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\famille  $famille
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, famille $famille)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\famille  $famille
     * @return \Illuminate\Http\Response
     */
    public function destroy(famille $famille)
    {
        $famille->delete();
        return redirect()->route('familles.index');

    }
}
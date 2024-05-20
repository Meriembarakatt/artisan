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
        $familles=Famille::orderBy('id', 'desc')->paginate(10);

        return view('familles.index', ['familles' => $familles]);
    }
    public function search(Request $request)
    {
        $output = "";

        $familles = Famille::where('famille', 'like', '%' . $request->search . '%')->get();

        foreach ($familles as $famille) {
            $output .= '<tr><td>' . $famille->famille . '</td>
            <td><form action="' . route("familles.edit", $famille->id) . '" method="GET" style="display: inline;">
                ' . csrf_field() . '
                <button type="button" class="btn-no-border" data-bs-toggle="modal" data-bs-target="#modalFamilleedit' . $famille->id . '">
                <i class="fa-solid fa-pen-to-square green-icon"></i>
                </button>
            </form>
            <form action="' . route("familles.destroy", $famille->id) . '" method="POST" style="display: inline;">
                ' . csrf_field() . '
                ' . method_field("DELETE") . '
                <button type="submit" class="btn-no-border" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cette famille ?\')">
                <i class="fa-solid fa-trash-can red-icon"></i></button>
            </form>
            <button type="button" class="btn-no-border" data-bs-toggle="modal" data-bs-target="#modalFamille' . $famille->id . '">
            <i class="fa-solid fa-eye  black-icon"></i>
            </button></td></tr>';
        }

        return response($output);
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
    public function show(Famille $famille)
{
    return view('familles.show', ['famille' => $famille]);
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\famille  $famille
     * @return \Illuminate\Http\Response
     */
    public function edit(Famille $famille)
    {
        return view('familles.edit', ['famille' => $famille]);
    }

/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Famille  $famille
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Famille $famille)
    {
        $validatedData = $request->validate([
            'famille' => 'required|max:255',
            // Ajoutez ici d'autres règles de validation pour les autres champs
        ]);

        $famille->update($validatedData);
        return redirect()->route('familles.index')->with('success', 'Famille mise à jour avec succès');
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
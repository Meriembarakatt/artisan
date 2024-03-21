<?php


namespace App\Http\Controllers;

use App\Models\Client;

use Illuminate\Http\Request;

class ClientController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $clients=Client::all();
        return view('client.index', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
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
            'nom' => 'required|max:255',
            // Ajoutez ici les autres règles de validation pour les autres champs
        ]);
        Client::create($request->all()) ;
            return redirect('/client')->with('succes','client Ajoute avec succes');
        
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
        //
    }
}

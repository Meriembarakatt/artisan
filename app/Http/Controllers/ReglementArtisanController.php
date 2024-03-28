<?php

namespace App\Http\Controllers;

use App\Models\reglementArtisan;
use Illuminate\Http\Request;

class ReglementArtisanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regArtisans = reglementArtisan::all();
        return view('reglement_artisan.index', compact('regArtisans'));
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\reglementArtisan  $reglementArtisan
     * @return \Illuminate\Http\Response
     */
    public function show(reglementArtisan $reglementArtisan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\reglementArtisan  $reglementArtisan
     * @return \Illuminate\Http\Response
     */
    public function edit(reglementArtisan $reglementArtisan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\reglementArtisan  $reglementArtisan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reglementArtisan $reglementArtisan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\reglementArtisan  $reglementArtisan
     * @return \Illuminate\Http\Response
     */
    public function destroy(reglementArtisan $reglementArtisan)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client; // Importez le modèle Client depuis le bon namespace


class ReglementController extends Controller
{
    public function reglementsClient(Client $client)
{
    $reglements = $client->reglements; // Supposons que la relation entre Client et Reglement soit bien définie
    return view('reglements.client', compact('reglements'));
}

}

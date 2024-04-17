<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artisan; // Importez le modèle Client depuis le bon namespace


class ReglementaController extends Controller
{
    public function reglementsartisan(Artisan $artisan)
{
    $reglements = $artisan->reglements; // Supposons que la relation entre Client et Reglement soit bien définie
    return view('reglements.artisan', compact('reglements'));
}

}

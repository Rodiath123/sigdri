<?php

namespace App\Http\Controllers;

use App\Models\AlerteMP;
use Illuminate\Http\Request;

class AlerteMPController extends Controller
{
    // Web : Liste des alertes
    public function indexWeb()
    {
        $alertes = AlerteMP::with(['uniteIndustrielle', 'matierePremiere'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('alertes.index', compact('alertes'));
    }

    // Web : Marquer une alerte comme traitée
    public function traiterWeb(Request $request, $id)
    {
        $alerte = AlerteMP::findOrFail($id);
        $alerte->est_traitee = true;
        $alerte->traite_par = $request->user()->id;
        $alerte->date_traitement = now();
        $alerte->save();

        return redirect()->route('alertes.index')
            ->with('success', 'Alerte marquée comme traitée.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Declaration;
use App\Models\UniteIndustrielle;
use Illuminate\Http\Request;

class DeclarationController extends Controller
{
    // Web : Liste des déclarations
    public function indexWeb()
    {
        $declarations = Declaration::with('uniteIndustrielle')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('declarations.index', compact('declarations'));
    }

    // Web : Détail d'une déclaration
    public function showWeb($id)
    {
        $declaration = Declaration::with([
            'uniteIndustrielle',
            'productionDetails.produit',
            'venteDetails.produit',
            'consommationMPDetails.matierePremiere'
        ])->findOrFail($id);
        
        return view('declarations.show', compact('declaration'));
    }

    // Web : Valider une déclaration
    public function validerWeb(Request $request, $id)
    {
        $declaration = Declaration::findOrFail($id);
        $declaration->statut = 'validee';
        $declaration->valide_par = $request->user()->id;
        $declaration->date_validation = now();
        $declaration->save();

        return redirect()->route('declarations.index')
            ->with('success', 'Déclaration validée avec succès.');
    }

    // Web : Rejeter une déclaration
    public function rejeterWeb(Request $request, $id)
    {
        $request->validate([
            'commentaire_rejet' => 'required|string'
        ]);

        $declaration = Declaration::findOrFail($id);
        $declaration->statut = 'rejetee';
        $declaration->commentaire_rejet = $request->commentaire_rejet;
        $declaration->save();

        return redirect()->route('declarations.index')
            ->with('success', 'Déclaration rejetée.');
    }
}
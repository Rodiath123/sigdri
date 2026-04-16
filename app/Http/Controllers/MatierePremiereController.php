<?php

namespace App\Http\Controllers;

use App\Models\MatierePremiere;
use Illuminate\Http\Request;

class MatierePremiereController extends Controller
{
    // Liste des matières premières
    public function index()
    {
        $matieres = MatierePremiere::orderBy('nom')->paginate(20);
        return view('matieres-premieres.index', compact('matieres'));
    }

    // Enregistrer une nouvelle matière première
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:100|unique:matiere_premieres',
            'origine' => 'required|in:locale,importee',
            'filiere' => 'required|string',
        ]);

        MatierePremiere::create($request->all());

        return redirect()->route('matieres-premieres.index')
            ->with('success', 'Matière première ajoutée avec succès.');
    }

    // Mettre à jour
    public function update(Request $request, $id)
    {
        $matiere = MatierePremiere::findOrFail($id);
        
        $request->validate([
            'nom' => 'required|string|max:100|unique:matiere_premieres,nom,' . $id,
            'origine' => 'required|in:locale,importee',
            'filiere' => 'required|string',
        ]);

        $matiere->update($request->all());

        return redirect()->route('matieres-premieres.index')
            ->with('success', 'Matière première modifiée avec succès.');
    }

    // Supprimer
    public function destroy($id)
    {
        $matiere = MatierePremiere::findOrFail($id);
        $matiere->delete();

        return redirect()->route('matieres-premieres.index')
            ->with('success', 'Matière première supprimée.');
    }

    // Activer/Désactiver
    public function toggle($id)
    {
        $matiere = MatierePremiere::findOrFail($id);
        $matiere->est_actif = !$matiere->est_actif;
        $matiere->save();

        return redirect()->route('matieres-premieres.index')
            ->with('success', 'Statut de la matière première mis à jour.');
    }
}
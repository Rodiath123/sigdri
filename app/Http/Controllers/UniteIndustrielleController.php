<?php

namespace App\Http\Controllers;

use App\Models\UniteIndustrielle;
use Illuminate\Http\Request;

class UniteIndustrielleController extends Controller
{
    // Liste des unités
    public function index()
    {
        $unites = UniteIndustrielle::orderBy('nom')->paginate(20);
        return view('unites.index', compact('unites'));
    }

    // Formulaire d'ajout (si besoin)
    public function create()
    {
        return view('unites.create');
    }

    // Enregistrer une nouvelle unité
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:150',
            'localisation' => 'nullable|string',
            'departement' => 'required|string',
            'filiere' => 'required|string',
            'capacite_installee' => 'nullable|numeric',
            'regime' => 'required|in:Privé,Public,Mixte',
            'contact_nom' => 'required|string',
            'contact_telephone' => 'nullable|string',
            'contact_email' => 'nullable|email',
        ]);

        UniteIndustrielle::create($request->all());

        return redirect()->route('unites.index')
            ->with('success', 'Unité ajoutée avec succès.');
    }

    // Afficher une unité
    public function show($id)
    {
        $unite = UniteIndustrielle::findOrFail($id);
        return view('unites.show', compact('unite'));
    }

    // Formulaire de modification
    public function edit($id)
    {
        $unite = UniteIndustrielle::findOrFail($id);
        return view('unites.edit', compact('unite'));
    }

    // Mettre à jour
    public function update(Request $request, $id)
    {
        $unite = UniteIndustrielle::findOrFail($id);
        
        $request->validate([
            'nom' => 'required|string|max:150',
            'departement' => 'required|string',
            'filiere' => 'required|string',
            'regime' => 'required|in:Privé,Public,Mixte',
            'contact_nom' => 'required|string',
        ]);

        $unite->update($request->all());

        return redirect()->route('unites.index')
            ->with('success', 'Unité modifiée avec succès.');
    }

    // Supprimer
    public function destroy($id)
    {
        $unite = UniteIndustrielle::findOrFail($id);
        $unite->delete();

        return redirect()->route('unites.index')
            ->with('success', 'Unité supprimée.');
    }

    // Activer/Désactiver
    public function toggle($id)
    {
        $unite = UniteIndustrielle::findOrFail($id);
        $unite->est_actif = !$unite->est_actif;
        $unite->save();

        return redirect()->route('unites.index')
            ->with('success', 'Statut mis à jour.');
    }
}
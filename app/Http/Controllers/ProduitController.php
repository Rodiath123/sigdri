<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    // Liste des produits
    public function index()
    {
        $produits = Produit::orderBy('nom')->paginate(20);
        return view('produits.index', compact('produits'));
    }

    // Enregistrer un nouveau produit
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:100|unique:produits',
            'unite' => 'required|string|max:20',
            'filiere' => 'required|string',
        ]);

        Produit::create($request->all());

        return redirect()->route('produits.index')
            ->with('success', 'Produit ajouté avec succès.');
    }

    // Mettre à jour
    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);
        
        $request->validate([
            'nom' => 'required|string|max:100|unique:produits,nom,' . $id,
            'unite' => 'required|string|max:20',
            'filiere' => 'required|string',
        ]);

        $produit->update($request->all());

        return redirect()->route('produits.index')
            ->with('success', 'Produit modifié avec succès.');
    }

    // Supprimer
    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return redirect()->route('produits.index')
            ->with('success', 'Produit supprimé.');
    }

    // Activer/Désactiver
    public function toggle($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->est_actif = !$produit->est_actif;
        $produit->save();

        return redirect()->route('produits.index')
            ->with('success', 'Statut du produit mis à jour.');
    }
}
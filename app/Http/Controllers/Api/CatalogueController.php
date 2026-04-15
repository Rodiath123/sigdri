<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CatalogueService;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    public function __construct(
        protected CatalogueService $catalogueService
    ) {}

    // ===== PRODUITS =====
    public function indexProduits(Request $request)
    {
        $filters = $request->only(['filiere', 'est_actif', 'search']);
        return response()->json($this->catalogueService->getAllProduits($filters));
    }

    public function showProduit(int $id)
    {
        return response()->json($this->catalogueService->getProduitById($id));
    }

    public function storeProduit(Request $request)
    {
        $data = $request->validate([
            'nom'     => 'required|string|max:100|unique:produits,nom',
            'unite'   => 'required|string|max:20',
            'filiere' => 'required|string|max:50',
        ]);

        $produit = $this->catalogueService->createProduit($data);

        return response()->json([
            'message' => 'Produit créé avec succès.',
            'produit' => $produit,
        ], 201);
    }

    public function updateProduit(Request $request, int $id)
    {
        $data = $request->validate([
            'nom'     => 'sometimes|string|max:100|unique:produits,nom,'.$id,
            'unite'   => 'sometimes|string|max:20',
            'filiere' => 'sometimes|string|max:50',
        ]);

        $produit = $this->catalogueService->updateProduit($id, $data);

        return response()->json([
            'message' => 'Produit mis à jour avec succès.',
            'produit' => $produit,
        ]);
    }

    public function desactiverProduit(int $id)
    {
        return response()->json([
            'message' => 'Produit désactivé.',
            'produit' => $this->catalogueService->desactiverProduit($id),
        ]);
    }

    public function activerProduit(int $id)
    {
        return response()->json([
            'message' => 'Produit activé.',
            'produit' => $this->catalogueService->activerProduit($id),
        ]);
    }

    // ===== MATIÈRES PREMIÈRES =====
    public function indexMatierePremieres(Request $request)
    {
        $filters = $request->only(['filiere', 'origine', 'est_actif', 'search']);
        return response()->json($this->catalogueService->getAllMatierePremieres($filters));
    }

    public function showMatierePremiere(int $id)
    {
        return response()->json($this->catalogueService->getMatierePremiereById($id));
    }

    public function storeMatierePremiere(Request $request)
    {
        $data = $request->validate([
            'nom'     => 'required|string|max:100|unique:matiere_premieres,nom',
            'origine' => 'required|in:locale,importée',
            'filiere' => 'required|string|max:50',
        ]);

        $mp = $this->catalogueService->createMatierePremiere($data);

        return response()->json([
            'message'          => 'Matière première créée avec succès.',
            'matiere_premiere' => $mp,
        ], 201);
    }

    public function updateMatierePremiere(Request $request, int $id)
    {
        $data = $request->validate([
            'nom'     => 'sometimes|string|max:100|unique:matiere_premieres,nom,'.$id,
            'origine' => 'sometimes|in:locale,importée',
            'filiere' => 'sometimes|string|max:50',
        ]);

        $mp = $this->catalogueService->updateMatierePremiere($id, $data);

        return response()->json([
            'message'          => 'Matière première mise à jour avec succès.',
            'matiere_premiere' => $mp,
        ]);
    }

    public function desactiverMatierePremiere(int $id)
    {
        return response()->json([
            'message'          => 'Matière première désactivée.',
            'matiere_premiere' => $this->catalogueService->desactiverMatierePremiere($id),
        ]);
    }

    public function activerMatierePremiere(int $id)
    {
        return response()->json([
            'message'          => 'Matière première activée.',
            'matiere_premiere' => $this->catalogueService->activerMatierePremiere($id),
        ]);
    }
}
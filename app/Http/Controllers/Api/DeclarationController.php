<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DeclarationService;
use Illuminate\Http\Request;

class DeclarationController extends Controller
{
    public function __construct(
        protected DeclarationService $declarationService
    ) {}

    public function index(Request $request)
    {
        $filters = $request->only([
            'statut', 'annee', 'trimestre', 'unite_industrielle_id'
        ]);
        return response()->json($this->declarationService->getAllDeclarations($filters));
    }

    public function show(int $id)
    {
        return response()->json($this->declarationService->getDeclarationById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'unite_industrielle_id'         => 'required|exists:unite_industrielles,id',
            'annee'                          => 'required|integer|min:2000|max:2100',
            'trimestre'                      => 'required|in:1,2,3,4',
            'productions'                    => 'nullable|array',
            'productions.*.produit_id'       => 'required|exists:produits,id',
            'productions.*.quantite_produite' => 'required|numeric|min:0',
            'ventes'                         => 'nullable|array',
            'ventes.*.produit_id'            => 'required|exists:produits,id',
            'ventes.*.quantite_vendue'       => 'required|numeric|min:0',
            'ventes.*.marche'                => 'required|in:local,export',
            'ventes.*.chiffre_affaires'      => 'required|numeric|min:0',
            'consommations'                  => 'nullable|array',
            'consommations.*.matiere_premiere_id' => 'required|exists:matiere_premieres,id',
            'consommations.*.quantite_utilisee'   => 'required|numeric|min:0',
        ]);

        $declaration = $this->declarationService->createDeclaration($data, $request->user()->id);

        return response()->json([
            'message'     => 'Déclaration soumise avec succès.',
            'declaration' => $declaration,
        ], 201);
    }

    public function valider(Request $request, int $id)
    {
        $declaration = $this->declarationService->validerDeclaration($id, $request->user()->id);

        return response()->json([
            'message'     => 'Déclaration validée avec succès.',
            'declaration' => $declaration,
        ]);
    }

    public function rejeter(Request $request, int $id)
    {
        $request->validate([
            'commentaire_rejet' => 'required|string',
        ]);

        $declaration = $this->declarationService->rejeterDeclaration(
            $id,
            $request->user()->id,
            $request->commentaire_rejet
        );

        return response()->json([
            'message'     => 'Déclaration rejetée.',
            'declaration' => $declaration,
        ]);
    }

    public function sync(Request $request)
    {
        $data = $request->validate([
            'unite_industrielle_id' => 'required|exists:unite_industrielles,id',
            'annee'                 => 'required|integer',
            'trimestre'             => 'required|in:1,2,3,4',
            'productions'           => 'nullable|array',
            'ventes'                => 'nullable|array',
            'consommations'         => 'nullable|array',
        ]);

        $declaration = $this->declarationService->syncDeclaration($data, $request->user()->id);

        return response()->json([
            'message'     => 'Déclaration synchronisée avec succès.',
            'declaration' => $declaration,
        ], 201);
    }
}
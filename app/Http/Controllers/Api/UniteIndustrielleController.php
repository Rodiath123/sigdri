<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UniteIndustrielleService;
use Illuminate\Http\Request;

class UniteIndustrielleController extends Controller
{
    public function __construct(
        protected UniteIndustrielleService $uniteService
    ) {}

    // Liste des unités
    public function index(Request $request)
    {
        $filters = $request->only(['departement', 'filiere', 'regime', 'est_actif', 'search']);
        $unites = $this->uniteService->getAllUnites($filters);
        return response()->json($unites);
    }

    // Détail d'une unité
    public function show(int $id)
    {
        $unite = $this->uniteService->getUniteById($id);
        return response()->json($unite);
    }

    // Créer une unité
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'                 => 'required|string|max:150',
            'localisation'        => 'required|string|max:255',
            'departement'         => 'required|string|max:50',
            'filiere'             => 'required|string|max:50',
            'capacite_installee'  => 'required|numeric|min:0',
            'regime'              => 'required|in:Privé,Public,Mixte',
            'contact_nom'         => 'required|string|max:100',
            'contact_telephone'   => 'required|string|max:20',
            'contact_email'       => 'required|email|max:100',
        ]);

        $unite = $this->uniteService->createUnite($data);

        return response()->json([
            'message' => 'Unité industrielle créée avec succès.',
            'unite'   => $unite,
        ], 201);
    }

    // Modifier une unité
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'nom'                => 'sometimes|string|max:150',
            'localisation'       => 'sometimes|string|max:255',
            'departement'        => 'sometimes|string|max:50',
            'filiere'            => 'sometimes|string|max:50',
            'capacite_installee' => 'sometimes|numeric|min:0',
            'regime'             => 'sometimes|in:Privé,Public,Mixte',
            'contact_nom'        => 'sometimes|string|max:100',
            'contact_telephone'  => 'sometimes|string|max:20',
            'contact_email'      => 'sometimes|email|max:100',
        ]);

        $unite = $this->uniteService->updateUnite($id, $data);

        return response()->json([
            'message' => 'Unité industrielle mise à jour avec succès.',
            'unite'   => $unite,
        ]);
    }

    // Désactiver une unité
    public function desactiver(int $id)
    {
        $unite = $this->uniteService->desactiverUnite($id);
        return response()->json([
            'message' => 'Unité industrielle désactivée.',
            'unite'   => $unite,
        ]);
    }

    // Activer une unité
    public function activer(int $id)
    {
        $unite = $this->uniteService->activerUnite($id);
        return response()->json([
            'message' => 'Unité industrielle activée.',
            'unite'   => $unite,
        ]);
    }
}
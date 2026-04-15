<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AlerteMPService;
use Illuminate\Http\Request;

class AlerteMPController extends Controller
{
    public function __construct(
        protected AlerteMPService $alerteService
    ) {}

    // Liste des alertes
    public function index(Request $request)
    {
        $filters = $request->only([
            'statut', 'est_traitee',
            'unite_industrielle_id', 'matiere_premiere_id'
        ]);
        return response()->json($this->alerteService->getAllAlertes($filters));
    }

    // Détail d'une alerte
    public function show(int $id)
    {
        return response()->json($this->alerteService->getAlerteById($id));
    }

    // Créer ou mettre à jour une alerte
    public function store(Request $request)
    {
        $data = $request->validate([
            'unite_industrielle_id' => 'required|exists:unite_industrielles,id',
            'matiere_premiere_id'   => 'required|exists:matiere_premieres,id',
            'statut'                => 'required|in:disponible,tension,rupture',
            'commentaire'           => 'nullable|string',
        ]);

        $alerte = $this->alerteService->createOrUpdateAlerte($data);

        return response()->json([
            'message' => 'Alerte enregistrée avec succès.',
            'alerte'  => $alerte->load(['uniteIndustrielle', 'matierePremiere']),
        ], 201);
    }

    // Marquer une alerte comme traitée
    public function traiter(Request $request, int $id)
    {
        $alerte = $this->alerteService->traiterAlerte($id, $request->user()->id);

        return response()->json([
            'message' => 'Alerte marquée comme traitée.',
            'alerte'  => $alerte->load(['uniteIndustrielle', 'matierePremiere', 'traitePar']),
        ]);
    }
}
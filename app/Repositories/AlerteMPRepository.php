<?php

namespace App\Repositories;

use App\Models\AlerteMP;

class AlerteMPRepository
{
    public function getAll(array $filters = [])
    {
        $query = AlerteMP::with([
            'uniteIndustrielle',
            'matierePremiere',
            'traitePar',
        ]);

        if (isset($filters['statut'])) {
            $query->where('statut', $filters['statut']);
        }

        if (isset($filters['est_traitee'])) {
            $query->where('est_traitee', $filters['est_traitee']);
        }

        if (isset($filters['unite_industrielle_id'])) {
            $query->where('unite_industrielle_id', $filters['unite_industrielle_id']);
        }

        if (isset($filters['matiere_premiere_id'])) {
            $query->where('matiere_premiere_id', $filters['matiere_premiere_id']);
        }

        return $query->orderBy('date_alerte', 'desc')->paginate(20);
    }

    public function findById(int $id)
    {
        return AlerteMP::with([
            'uniteIndustrielle',
            'matierePremiere',
            'traitePar',
        ])->findOrFail($id);
    }

    public function createOrUpdate(array $data)
    {
        return AlerteMP::updateOrCreate(
            [
                'unite_industrielle_id' => $data['unite_industrielle_id'],
                'matiere_premiere_id'   => $data['matiere_premiere_id'],
            ],
            $data
        );
    }

    public function traiter(int $id, int $agentId)
    {
        $alerte = AlerteMP::findOrFail($id);
        $alerte->update([
            'est_traitee'     => true,
            'traite_par'      => $agentId,
            'date_traitement' => now(),
        ]);
        return $alerte;
    }
}
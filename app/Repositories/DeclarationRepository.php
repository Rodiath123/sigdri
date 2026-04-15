<?php

namespace App\Repositories;

use App\Models\Declaration;
use App\Models\HistoriqueDeclaration;

class DeclarationRepository
{
    public function getAll(array $filters = [])
    {
        $query = Declaration::with([
            'uniteIndustrielle',
            'productionDetails.produit',
            'venteDetails.produit',
            'consommationMPDetails.matierePremiere',
        ]);

        if (isset($filters['statut'])) {
            $query->where('statut', $filters['statut']);
        }

        if (isset($filters['annee'])) {
            $query->where('annee', $filters['annee']);
        }

        if (isset($filters['trimestre'])) {
            $query->where('trimestre', $filters['trimestre']);
        }

        if (isset($filters['unite_industrielle_id'])) {
            $query->where('unite_industrielle_id', $filters['unite_industrielle_id']);
        }

        return $query->paginate(20);
    }

    public function findById(int $id)
    {
        return Declaration::with([
            'uniteIndustrielle',
            'productionDetails.produit',
            'venteDetails.produit',
            'consommationMPDetails.matierePremiere',
            'historiques.utilisateur',
        ])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Declaration::create($data);
    }

    public function update(int $id, array $data)
    {
        $declaration = Declaration::findOrFail($id);
        $declaration->update($data);
        return $declaration;
    }

    public function ajouterHistorique(array $data)
    {
        return HistoriqueDeclaration::create($data);
    }
}
<?php

namespace App\Repositories;

use App\Models\Produit;
use App\Models\MatierePremiere;

class CatalogueRepository
{
    // ===== PRODUITS =====
    public function getAllProduits(array $filters = [])
    {
        $query = Produit::query();

        if (isset($filters['filiere'])) {
            $query->where('filiere', $filters['filiere']);
        }

        if (isset($filters['est_actif'])) {
            $query->where('est_actif', $filters['est_actif']);
        }

        if (isset($filters['search'])) {
            $query->where('nom', 'like', '%'.$filters['search'].'%');
        }

        return $query->paginate(20);
    }

    public function findProduitById(int $id)
    {
        return Produit::findOrFail($id);
    }

    public function createProduit(array $data)
    {
        return Produit::create($data);
    }

    public function updateProduit(int $id, array $data)
    {
        $produit = Produit::findOrFail($id);
        $produit->update($data);
        return $produit;
    }

    public function toggleProduit(int $id, bool $actif)
    {
        $produit = Produit::findOrFail($id);
        $produit->update(['est_actif' => $actif]);
        return $produit;
    }

    // ===== MATIÈRES PREMIÈRES =====
    public function getAllMatierePremieres(array $filters = [])
    {
        $query = MatierePremiere::query();

        if (isset($filters['filiere'])) {
            $query->where('filiere', $filters['filiere']);
        }

        if (isset($filters['origine'])) {
            $query->where('origine', $filters['origine']);
        }

        if (isset($filters['est_actif'])) {
            $query->where('est_actif', $filters['est_actif']);
        }

        if (isset($filters['search'])) {
            $query->where('nom', 'like', '%'.$filters['search'].'%');
        }

        return $query->paginate(20);
    }

    public function findMatierePremiere(int $id)
    {
        return MatierePremiere::findOrFail($id);
    }

    public function createMatierePremiere(array $data)
    {
        return MatierePremiere::create($data);
    }

    public function updateMatierePremiere(int $id, array $data)
    {
        $mp = MatierePremiere::findOrFail($id);
        $mp->update($data);
        return $mp;
    }

    public function toggleMatierePremiere(int $id, bool $actif)
    {
        $mp = MatierePremiere::findOrFail($id);
        $mp->update(['est_actif' => $actif]);
        return $mp;
    }
}
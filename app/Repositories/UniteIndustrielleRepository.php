<?php

namespace App\Repositories;

use App\Models\UniteIndustrielle;

class UniteIndustrielleRepository
{
    public function getAll(array $filters = [])
    {
        $query = UniteIndustrielle::query();

        if (isset($filters['departement'])) {
            $query->where('departement', $filters['departement']);
        }

        if (isset($filters['filiere'])) {
            $query->where('filiere', $filters['filiere']);
        }

        if (isset($filters['regime'])) {
            $query->where('regime', $filters['regime']);
        }

        if (isset($filters['est_actif'])) {
            $query->where('est_actif', $filters['est_actif']);
        }

        if (isset($filters['search'])) {
            $query->where('nom', 'like', '%'.$filters['search'].'%');
        }

        return $query->paginate(20);
    }

    public function findById(int $id)
    {
        return UniteIndustrielle::findOrFail($id);
    }

    public function create(array $data)
    {
        return UniteIndustrielle::create($data);
    }

    public function update(int $id, array $data)
    {
        $unite = UniteIndustrielle::findOrFail($id);
        $unite->update($data);
        return $unite;
    }

    public function desactiver(int $id)
    {
        $unite = UniteIndustrielle::findOrFail($id);
        $unite->update(['est_actif' => false]);
        return $unite;
    }

    public function activer(int $id)
    {
        $unite = UniteIndustrielle::findOrFail($id);
        $unite->update(['est_actif' => true]);
        return $unite;
    }
}
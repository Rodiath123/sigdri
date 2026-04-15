<?php

namespace App\Services;

use App\Repositories\AlerteMPRepository;

class AlerteMPService
{
    public function __construct(
        protected AlerteMPRepository $alerteRepository
    ) {}

    public function getAllAlertes(array $filters = [])
    {
        return $this->alerteRepository->getAll($filters);
    }

    public function getAlerteById(int $id)
    {
        return $this->alerteRepository->findById($id);
    }

    public function createOrUpdateAlerte(array $data)
    {
        // Seules les tensions et ruptures génèrent des alertes
        if ($data['statut'] === 'disponible') {
            $data['est_traitee'] = true;
        } else {
            $data['est_traitee'] = false;
        }

        $data['date_alerte'] = now();

        return $this->alerteRepository->createOrUpdate($data);
    }

    public function traiterAlerte(int $id, int $agentId)
    {
        return $this->alerteRepository->traiter($id, $agentId);
    }
}
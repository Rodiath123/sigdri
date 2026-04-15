<?php

namespace App\Services;

use App\Repositories\UniteIndustrielleRepository;

class UniteIndustrielleService
{
    public function __construct(
        protected UniteIndustrielleRepository $uniteRepository
    ) {}

    public function getAllUnites(array $filters = [])
    {
        return $this->uniteRepository->getAll($filters);
    }

    public function getUniteById(int $id)
    {
        return $this->uniteRepository->findById($id);
    }

    public function createUnite(array $data)
    {
        return $this->uniteRepository->create($data);
    }

    public function updateUnite(int $id, array $data)
    {
        return $this->uniteRepository->update($id, $data);
    }

    public function desactiverUnite(int $id)
    {
        return $this->uniteRepository->desactiver($id);
    }

    public function activerUnite(int $id)
    {
        return $this->uniteRepository->activer($id);
    }
}
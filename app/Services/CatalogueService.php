<?php

namespace App\Services;

use App\Repositories\CatalogueRepository;

class CatalogueService
{
    public function __construct(
        protected CatalogueRepository $catalogueRepository
    ) {}

    // ===== PRODUITS =====
    public function getAllProduits(array $filters = [])
    {
        return $this->catalogueRepository->getAllProduits($filters);
    }

    public function getProduitById(int $id)
    {
        return $this->catalogueRepository->findProduitById($id);
    }

    public function createProduit(array $data)
    {
        return $this->catalogueRepository->createProduit($data);
    }

    public function updateProduit(int $id, array $data)
    {
        return $this->catalogueRepository->updateProduit($id, $data);
    }

    public function desactiverProduit(int $id)
    {
        return $this->catalogueRepository->toggleProduit($id, false);
    }

    public function activerProduit(int $id)
    {
        return $this->catalogueRepository->toggleProduit($id, true);
    }

    // ===== MATIÈRES PREMIÈRES =====
    public function getAllMatierePremieres(array $filters = [])
    {
        return $this->catalogueRepository->getAllMatierePremieres($filters);
    }

    public function getMatierePremiereById(int $id)
    {
        return $this->catalogueRepository->findMatierePremiere($id);
    }

    public function createMatierePremiere(array $data)
    {
        return $this->catalogueRepository->createMatierePremiere($data);
    }

    public function updateMatierePremiere(int $id, array $data)
    {
        return $this->catalogueRepository->updateMatierePremiere($id, $data);
    }

    public function desactiverMatierePremiere(int $id)
    {
        return $this->catalogueRepository->toggleMatierePremiere($id, false);
    }

    public function activerMatierePremiere(int $id)
    {
        return $this->catalogueRepository->toggleMatierePremiere($id, true);
    }
}
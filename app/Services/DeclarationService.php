<?php

namespace App\Services;

use App\Models\ProductionDetail;
use App\Models\VenteDetail;
use App\Models\ConsommationMPDetail;
use App\Repositories\DeclarationRepository;
use Illuminate\Support\Facades\DB;

class DeclarationService
{
    public function __construct(
        protected DeclarationRepository $declarationRepository
    ) {}

    public function getAllDeclarations(array $filters = [])
    {
        return $this->declarationRepository->getAll($filters);
    }

    public function getDeclarationById(int $id)
    {
        return $this->declarationRepository->findById($id);
    }

    public function createDeclaration(array $data, int $userId)
    {
        return DB::transaction(function () use ($data, $userId) {

            $declaration = $this->declarationRepository->create([
                'unite_industrielle_id' => $data['unite_industrielle_id'],
                'annee'                 => $data['annee'],
                'trimestre'             => $data['trimestre'],
                'statut'                => 'en_attente',
                'date_soumission'       => now(),
            ]);

            // Productions
            if (!empty($data['productions'])) {
                foreach ($data['productions'] as $prod) {
                    ProductionDetail::create([
                        'declaration_id'   => $declaration->id,
                        'produit_id'       => $prod['produit_id'],
                        'quantite_produite' => $prod['quantite_produite'],
                    ]);
                }
            }

            // Ventes
            if (!empty($data['ventes'])) {
                foreach ($data['ventes'] as $vente) {
                    VenteDetail::create([
                        'declaration_id'  => $declaration->id,
                        'produit_id'      => $vente['produit_id'],
                        'quantite_vendue' => $vente['quantite_vendue'],
                        'marche'          => $vente['marche'],
                        'chiffre_affaires' => $vente['chiffre_affaires'],
                    ]);
                }
            }

            // Consommations MP
            if (!empty($data['consommations'])) {
                foreach ($data['consommations'] as $conso) {
                    ConsommationMPDetail::create([
                        'declaration_id'      => $declaration->id,
                        'matiere_premiere_id' => $conso['matiere_premiere_id'],
                        'quantite_utilisee'   => $conso['quantite_utilisee'],
                    ]);
                }
            }

            // Historique
            $this->declarationRepository->ajouterHistorique([
                'declaration_id'  => $declaration->id,
                'utilisateur_id'  => $userId,
                'action'          => 'creation',
                'nouvelle_valeur' => $declaration->toArray(),
            ]);

            return $declaration->load([
                'productionDetails.produit',
                'venteDetails.produit',
                'consommationMPDetails.matierePremiere',
            ]);
        });
    }

    public function validerDeclaration(int $id, int $agentId)
    {
        $declaration = $this->declarationRepository->findById($id);

        if ($declaration->statut !== 'en_attente') {
            throw new \Exception('Seule une déclaration en attente peut être validée.', 422);
        }

        $ancienne = $declaration->toArray();

        $this->declarationRepository->update($id, [
            'statut'          => 'validee',
            'valide_par'      => $agentId,
            'date_validation' => now(),
        ]);

        $this->declarationRepository->ajouterHistorique([
            'declaration_id'  => $id,
            'utilisateur_id'  => $agentId,
            'action'          => 'validation',
            'ancienne_valeur' => $ancienne,
            'nouvelle_valeur' => ['statut' => 'validee'],
        ]);

        return $this->declarationRepository->findById($id);
    }

    public function rejeterDeclaration(int $id, int $agentId, string $commentaire)
    {
        $declaration = $this->declarationRepository->findById($id);

        if ($declaration->statut !== 'en_attente') {
            throw new \Exception('Seule une déclaration en attente peut être rejetée.', 422);
        }

        $ancienne = $declaration->toArray();

        $this->declarationRepository->update($id, [
            'statut'             => 'rejetee',
            'commentaire_rejet'  => $commentaire,
        ]);

        $this->declarationRepository->ajouterHistorique([
            'declaration_id'  => $id,
            'utilisateur_id'  => $agentId,
            'action'          => 'rejet',
            'ancienne_valeur' => $ancienne,
            'nouvelle_valeur' => ['statut' => 'rejetee', 'commentaire' => $commentaire],
        ]);

        return $this->declarationRepository->findById($id);
    }

    public function syncDeclaration(array $data, int $userId)
    {
        $data['statut'] = 'en_attente';
        return $this->createDeclaration($data, $userId);
    }
}
<?php

namespace App\Repository;

use App\Entity\Paiement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Paiement>
 */
class PaiementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Paiement::class);
    }

    // CREATE: Ajouter une nouvelle donnée
    public function create(Paiement $data): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($data); // Préparer l'entité pour l'insertion
        $entityManager->flush(); // Sauvegarder l'entité dans la base de données
    }

    // READ: Trouver tous les données
    public function findAllDatas(): array
    {
        return $this->findBy([], ['id' => 'ASC']); // Retourne tous les données triés par ID croissant
    }

    // READ: Trouver une donnée par son ID
    public function findDataById(int $id): Paiement
    {
        return $this->find($id); // Cherche un client par son ID
    }

    // UPDATE: Mettre à jour une donnée existant
    public function update(Paiement $data): Paiement
    {
        $entityManager = $this->getEntityManager();
        $entityManager->flush(); // Sauvegarder les changements dans la base de données

        return $data;
    }

    // DELETE: Supprimer une donnée
    public function delete(Paiement $data): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($data); // Supprimer l'entité
        $entityManager->flush(); // Appliquer la suppression dans la base de données
    }
}

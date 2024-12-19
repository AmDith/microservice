<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Client>
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    // CREATE: Ajouter une nouvelle donnée
    public function create(Client $data): void
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
    public function findDataById(int $id): Client
    {
        return $this->find($id); // Cherche un client par son ID
    }

    // UPDATE: Mettre à jour une donnée existant
    public function update(Client $data): Client
    {
        $entityManager = $this->getEntityManager();
        $entityManager->flush(); // Sauvegarder les changements dans la base de données

        return $data;
    }

    // DELETE: Supprimer une donnée
    public function delete(Client $data): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($data); // Supprimer l'entité
        $entityManager->flush(); // Appliquer la suppression dans la base de données
    }

    //    /**
    //     * @return Client[] Returns an array of Client objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Client
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\DetteRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class DetteController extends AbstractController
{
    #[Route('/api/dettes', name: 'api_dettes', methods: ['GET','POST'])]
    public function sendDettes(DetteRepository $detteRepository): JsonResponse
    {
        // Récupérer tous les dettes de la base de données
        $dettes = $detteRepository->findAll();

        // Transformer les dettes en un tableau de données simples
        $data = [];
        foreach ($dettes as $dette) {
            $dette->setMontantRestant(getMontant() - getMontantVerser());
            $data[] = [
                'id' => $dette->getId(),
                'date' => $dette->getDateCreate(),
                'etat' => $dette->getEtat(),
                'montant' => $dette->getMontant(),
                'montantVerser' => $dette->getMontantVerser(),
                'montantVerser' => $dette->getMontantRestant(),
                'paiements' => $dette->getPaiements(),
                'demande' => $dette->getDemande(),
                'client' => $dette->getClient(),
            ];
        }

        // Retourner les données sous forme de JSON
        return new JsonResponse($data);
    }
}

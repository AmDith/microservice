<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PaiementRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class PaiementController extends AbstractController
{
    #[Route('/api/paiements', name: 'api_paiements', methods: ['GET','POST'])]
    public function sendPaiements(PaiementRepository $paiementRepository): JsonResponse
    {
        // Récupérer tous les paiements de la base de données
        $paiements = $paiementRepository->findAll();

        // Transformer les paiements en un tableau de données simples
        $data = [];
        foreach ($paiements as $paiement) {
            $data[] = [
                'id' => $paiement->getId(),
                'date' => $paiement->getDateCreate(),
                'montant' => $paiement->getMontant(),
                'dette' => $paiement->getDette(),
            ];
        }

        // Retourner les données sous forme de JSON
        return new JsonResponse($data);
    }
}

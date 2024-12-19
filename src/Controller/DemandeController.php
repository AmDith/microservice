<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\DemandeRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class DemandeController extends AbstractController
{
    #[Route('/api/demandes', name: 'api_demandes', methods: ['GET','POST'])]
    public function sendDemandes(DemandeRepository $demandeRepository): JsonResponse
    {
        // Récupérer tous les demandes de la base de données
        $demandes = $demandeRepository->findAll();

        // Transformer les demandes en un tableau de données simples
        $data = [];
        foreach ($demandes as $demande) {
            $data[] = [
                'id' => $demande->getId(),
                'date' => $demande->getDateCreate(),
                'etat' => $demande->getEtat(),
                'montant' => $demande->getMontant(),
                'dette' => $demande->getDette(),
                'demandeArticle' => $demande->getDemandeArticles(),
                'client' => $demande->getClient(),
            ];
        }

        // Retourner les données sous forme de JSON
        return new JsonResponse($data);
    }
}

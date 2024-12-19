<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\DemandeArticleRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class DemandeArticleController extends AbstractController
{
    #[Route('/api/demandeArticles', name: 'api_demandeArticles', methods: ['GET','POST'])]
    public function sendDemandeArticles(DemandeArticleRepository $demandeArticleRepository): JsonResponse
    {
        // Récupérer tous les demandeArticles de la base de données
        $demandeArticles = $demandeArticleRepository->findAll();

        // Transformer les demandeArticles en un tableau de données simples
        $data = [];
        foreach ($demandeArticles as $demandeArticle) {
            $data[] = [
                'id' => $demandeArticle->getId(),
                'date' => $demandeArticle->getDateCreate(),
                'somme' => $demandeArticle->getSomme(),
                'qteDemande' => $demandeArticle->getQteDemande(),
                'demande' => $demandeArticle->getDemande(),
                'article' => $demandeArticle->getArticle(),
            ];
        }

        // Retourner les données sous forme de JSON
        return new JsonResponse($data);
    }
}

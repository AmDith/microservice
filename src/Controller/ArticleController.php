<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ArticleController extends AbstractController
{
    #[Route('/api/articles', name: 'api_articles', methods: ['GET','POST'])]
    public function sendArticles(ArticleRepository $articleRepository): JsonResponse
    {
        // Récupérer tous les articles de la base de données
        $articles = $articleRepository->findAll();

        // Transformer les articles en un tableau de données simples
        $data = [];
        foreach ($articles as $article) {
            $data[] = [
                'id' => $article->getId(),
                'libelle' => $article->getLibelle(),
                'prix' => $article->getPrix(),
                'qteStock' => $article->getQteStock(),
                'demandeArticles' => $article->getDemandeArticles(),
            ];
        }

        // Retourner les données sous forme de JSON
        return new JsonResponse($data);
    }

    #[Route('http://127.0.0.1:8000/api/articlespost', name: 'api_articles_post', methods: ['POST'])]
    public function createArticle(
        Request $request,
        EntityManagerInterface $entityManager,
    ): JsonResponse {
        // Récupérer les données JSON
        $data = json_decode($request->getContent(), true);
        // Vérification des données requises
        // if (!$data || !isset($data['nom'], $data['prenom'], $data['telephone'], $data['adresse'])) {
        //     return new JsonResponse(['error' => 'Invalid or missing data'], 400);
        // }

        // // Crée une nouvelle entité Client
        // $client = new Client();
        // $client->setNom($data['nom']);
        // $client->setPrenom($data['prenom']);
        // $client->setTel($data['telephone']);
        // $client->setAdresse($data['adresse']);

        // // Validation des données (optionnel)
        // $errors = $validator->validate($client);
        // if (count($errors) > 0) {
        //     return new JsonResponse(['error' => (string) $errors], 400);
        // }

        // // Persiste et sauvegarde dans la base de données
        // $clientRepository->create($client);

        return new JsonResponse(['message' => 'Client created successfully'], 201);
    }


}

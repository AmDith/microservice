<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ClientController extends AbstractController
{
    #[Route('/api/clients', name: 'api_clients', methods: ['GET','POST'])]
    public function sendClients(ClientRepository $clientRepository): JsonResponse
    {
        // Récupérer tous les clients de la base de données
        $clients = $clientRepository->findAll();

        // Transformer les clients en un tableau de données simples
        $data = [];
        foreach ($clients as $client) {
            $data[] = [
                'id' => $client->getId(),
                'nom' => $client->getNom(),
                'prenom' => $client->getPrenom(),
                'tel' => $client->getTel(),
                'adresse' => $client->getAdresse(),
                'dettes' => $client->getDettes(),
                'demandes' => $client->getDemandes(),
                'userC' => $client->getUserC(),
                'montantDue' => '5000 FCFA', // Ici, tu peux calculer le montant dû si nécessaire
            ];
        }

        // Retourner les données sous forme de JSON
        return new JsonResponse($data);
    }

    #[Route('/api/clientspost', name: 'api_clients_post', methods: ['POST'])]
    public function createClient(
        Request $request,
        EntityManagerInterface $entityManager,
    ): JsonResponse {
        // Récupérer les données JSON
        $data = json_decode($request->getContent(), true);

        // Vérification des données requises
        if (!$data || !isset($data['nom'], $data['prenom'], $data['telephone'], $data['adresse'])) {
            return new JsonResponse(['error' => 'Invalid or missing data'], 400);
        }

        // Crée une nouvelle entité Client
        $client = new Client();
        $client->setNom($data['nom']);
        $client->setPrenom($data['prenom']);
        $client->setTel($data['telephone']);
        $client->setAdresse($data['adresse']);

        // Validation des données (optionnel)
        $errors = $validator->validate($client);
        if (count($errors) > 0) {
            return new JsonResponse(['error' => (string) $errors], 400);
        }

        // Persiste et sauvegarde dans la base de données
        $clientRepository->create($client);

        return new JsonResponse(['message' => 'Client created successfully'], 201);
    }


}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/api/users', name: 'api_users', methods: ['GET','POST'])]
    public function sendUsers(UserRepository $userRepository): JsonResponse
    {
        // Récupérer tous les users de la base de données
        $users = $userRepository->findAll();

        // Transformer les users en un tableau de données simples
        $data = [];
        foreach ($users as $user) {
            $data[] = [
                'id' => $user->getId(),
                'date' => $user->getDateCreate(),
                'etat' => $user->getEtat(),
                'login' => $user->getLogin(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'role' => $user->getRole(),
            ];
        }

        // Retourner les données sous forme de JSON
        return new JsonResponse($data);
    }
}

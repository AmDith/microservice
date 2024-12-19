<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\RoleRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class RoleController extends AbstractController
{
    #[Route('/api/roles', name: 'api_roles', methods: ['GET','POST'])]
    public function sendRoles(RoleRepository $roleRepository): JsonResponse
    {
        // Récupérer tous les roles de la base de données
        $roles = $roleRepository->findAll();

        // Transformer les roles en un tableau de données simples
        $data = [];
        foreach ($roles as $role) {
            $data[] = [
                'id' => $role->getId(),
                'date' => $role->getDateCreate(),
                'nomRole' => $role->getNomRole(),
            ];
        }

        // Retourner les données sous forme de JSON
        return new JsonResponse($data);
    }
}

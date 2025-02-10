<?php

namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/clients', name: 'api_clients_')]
class ClientController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function getAllClients(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $clients = $entityManager->getRepository(Client::class)->findAll();
        return new JsonResponse($serializer->serialize($clients, 'json'), JsonResponse::HTTP_OK, [], true);
    }

}

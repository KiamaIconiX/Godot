<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;


#[Route('/api/commandes', name: 'api_commandes_')]
class CommandeController extends AbstractController
{
    #[Route('/en-cours', name: 'en_cours', methods: ['GET'])]
    public function commandesEnCours(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $commandes =  $entityManager->getRepository(Commande::class)->findBy(['status' => 'en cours']);
        return new JsonResponse($serializer->serialize($commandes, 'json'), JsonResponse::HTTP_OK, [], true);
    }
}

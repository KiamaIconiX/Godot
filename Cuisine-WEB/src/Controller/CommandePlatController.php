<?php

namespace App\Controller;

use App\Entity\CommandePlat;
use App\Entity\Commande;
use App\Entity\Plat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/commande-plats', name: 'api_commande_plats_')]
class CommandePlatController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function getAll(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $commandePlats = $entityManager->getRepository(CommandePlat::class)->findAll();
        return new JsonResponse($serializer->serialize($commandePlats, 'json'), JsonResponse::HTTP_OK, [], true);
    }

    #[Route('', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['quantite'], $data['commande_id'], $data['plat_id'])) {
            return new JsonResponse(['error' => 'Données invalides'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $commande = $entityManager->getRepository(Commande::class)->find($data['commande_id']);
        $plat = $entityManager->getRepository(Plat::class)->find($data['plat_id']);

        if (!$commande || !$plat) {
            return new JsonResponse(['error' => 'Commande ou Plat introuvable'], JsonResponse::HTTP_NOT_FOUND);
        }

        $commandePlat = new CommandePlat();
        $commandePlat->setQuantite($data['quantite']);
        $commandePlat->setCommande($commande);
        $commandePlat->setPlat($plat);

        $entityManager->persist($commandePlat);
        $entityManager->flush();

        return new JsonResponse($serializer->serialize($commandePlat, 'json', ['groups' => 'commande_plat']), JsonResponse::HTTP_CREATED, [], true);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $commandePlat = $entityManager->getRepository(CommandePlat::class)->find($id);

        if (!$commandePlat) {
            return new JsonResponse(['error' => 'CommandePlat introuvable'], JsonResponse::HTTP_NOT_FOUND);
        }

        $entityManager->remove($commandePlat);
        $entityManager->flush();

        return new JsonResponse(['message' => 'CommandePlat supprimée avec succès'], JsonResponse::HTTP_OK);
    }
}

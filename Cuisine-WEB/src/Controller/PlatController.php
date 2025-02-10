<?php

namespace App\Controller;

use App\Entity\Plat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/plats', name: 'api_plats_')]
class PlatController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function getAllPlats(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $plats = $entityManager->getRepository(Plat::class)->findAll();
        return new JsonResponse($serializer->serialize($plats, 'json'), JsonResponse::HTTP_OK, [], true);
    }

    #[Route('', methods: ['POST'])]
    public function createPlat(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['nom'], $data['tempsCuisson'], $data['prix'])) {
            return new JsonResponse(['error' => 'Données invalides'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $plat = new Plat();
        $plat->setNom($data['nom']);
        $plat->setTempsCuisson($data['tempsCuisson']);
        $plat->setPrix($data['prix']);

        $entityManager->persist($plat);
        $entityManager->flush();

        return new JsonResponse($serializer->serialize($plat, 'json'), JsonResponse::HTTP_CREATED, [], true);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function deletePlat($id, EntityManagerInterface $entityManager): JsonResponse
    {
        $plat = $entityManager->getRepository(Plat::class)->find($id);

        if (!$plat) {
            return new JsonResponse(['error' => 'Plat non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        $entityManager->remove($plat);
        $entityManager->flush();

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}

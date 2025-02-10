<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Entity\Plat;
use App\Entity\Ingredient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/recettes', name: 'api_recettes_')]
class RecetteController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function getAllRecettes(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        try {
            $recettes = $entityManager->getRepository(Recette::class)->findAll();
            return new JsonResponse($serializer->serialize($recettes, 'json'), JsonResponse::HTTP_OK, [], true);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Erreur lors de la récupération des recettes: ' . $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('', methods: ['POST'])]
    public function createRecette(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);

            if (!isset($data['plat'], $data['ingredient'])) {
                return new JsonResponse(['error' => 'Données invalides. Assurez-vous que "plat" et "ingredient" sont présents.'], JsonResponse::HTTP_BAD_REQUEST);
            }

            $plat = $entityManager->getRepository(Plat::class)->find($data['plat']);
            $ingredient = $entityManager->getRepository(Ingredient::class)->find($data['ingredient']);

            if (!$plat || !$ingredient) {
                return new JsonResponse(['error' => 'Plat ou ingrédient introuvable'], JsonResponse::HTTP_NOT_FOUND);
            }

            $recette = new Recette();
            $recette->setPlat($plat);
            $recette->setIngredient($ingredient);

            $entityManager->persist($recette);
            $entityManager->flush();

            return new JsonResponse($serializer->serialize($recette, 'json', ['groups' => 'recette']), JsonResponse::HTTP_CREATED, [], true);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Erreur lors de la création de la recette: ' . $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function deleteRecette($id, EntityManagerInterface $entityManager): JsonResponse
    {
        try {
            $recette = $entityManager->getRepository(Recette::class)->find($id);

            if (!$recette) {
                return new JsonResponse(['error' => 'Recette non trouvée'], JsonResponse::HTTP_NOT_FOUND);
            }

            $entityManager->remove($recette);
            $entityManager->flush();

            return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Erreur lors de la suppression de la recette: ' . $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

<?php

namespace App\Controller;

use App\Entity\Ingredient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/ingredients', name: 'api_ingredients_')]
class IngredientController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function getAllIngredients(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $ingredients = $entityManager->getRepository(Ingredient::class)->findAll();
        return new JsonResponse($serializer->serialize($ingredients, 'json'), JsonResponse::HTTP_OK, [], true);
    }

    #[Route('', methods: ['POST'])]
    public function createIngredient(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['nom'], $data['stock'], $data['seuilAlerte'])) {
            return new JsonResponse(['error' => 'Données invalides'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $ingredient = new Ingredient();
        $ingredient->setNom($data['nom']);
        $ingredient->setStock($data['stock']);
        $ingredient->setSeuilAlerte($data['seuilAlerte']);

        $entityManager->persist($ingredient);
        $entityManager->flush();

        return new JsonResponse($serializer->serialize($ingredient, 'json'), JsonResponse::HTTP_CREATED, [], true);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function deleteIngredient($id, EntityManagerInterface $entityManager): JsonResponse
    {
        $ingredient = $entityManager->getRepository(Ingredient::class)->find($id);

        if (!$ingredient) {
            return new JsonResponse(['error' => 'Ingrédient non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        $entityManager->remove($ingredient);
        $entityManager->flush();

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}

<?php

// src/Controller/StatisticsController.php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/statistics', name: 'api_statistics_')]
class StatisticsController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function getStatistics(EntityManagerInterface $entityManager): JsonResponse
    {
        try {
            // Récupérer le montant total des ventes (somme de 'montantTotal' dans Commande)
            $query = $entityManager->createQuery(
                'SELECT SUM(c.montantTotal) as totalSales
                 FROM App\Entity\Commande c'
            );
            $statistics = $query->getSingleResult();
            
            $totalSales = $statistics['totalSales'];

            // Récupérer le nombre de plats servis (compte des CommandePlat)
            $platCountQuery = $entityManager->createQuery(
                'SELECT SUM(cp.quantite) as totalPlats
                 FROM App\Entity\CommandePlat cp'
            );
            $platCount = $platCountQuery->getSingleResult();
            
            $totalPlats = $platCount['totalPlats'];

            return new JsonResponse([
                'totalSales' => $totalSales,
                'totalPlats' => $totalPlats,
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Erreur lors de la récupération des statistiques: ' . $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

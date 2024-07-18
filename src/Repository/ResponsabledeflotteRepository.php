<?php

namespace App\Repository;

use App\Entity\Vehicle;
use App\Entity\Responsabledeflotte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Responsabledeflotte>
 */
class ResponsabledeflotteRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Responsabledeflotte::class);
    }

    public function suivreHistoriqueVehicule(Vehicle $vehicle): array
    {
        // Example logic to retrieve vehicle history
        $vehicleHistoryRepository = $this->entityManager->getRepository('App:VehicleHistory');
        $history = $vehicleHistoryRepository->findBy(['vehicle' => $vehicle], ['date' => 'DESC']);

        // Log the retrieval of history
        $this->logger->info('Vehicle history retrieved.', [
            'vehicle_id' => $vehicle->getId(),
            'history_count' => count($history),
        ]);

        return $history;
    }

    public function gererBudgetVehicule(): void
    {
        // Logique pour gérer le budget du véhicule
    }


    //    /**
    //     * @return Responsabledeflotte[] Returns an array of Responsabledeflotte objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Responsabledeflotte
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

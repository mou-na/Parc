<?php

namespace App\Repository;

use App\Entity\Vehicle;
use App\Repository\VehicleRepository;
use Psr\Log\LoggerInterface;
use App\Entity\Responsabledeflotte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Responsabledeflotte>
 */
class ResponsabledeflotteRepository extends ServiceEntityRepository
{
    private $vehicleRepository;
    private $logger;

    public function __construct(ManagerRegistry $registry, VehicleRepository $vehicleRepository, LoggerInterface $logger)
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->logger = $logger;
        parent::__construct($registry, Responsabledeflotte::class);
    }

    public function suivreHistoriqueVehicule(Vehicle $vehicle): array
    {
        // Example logic to retrieve vehicle history
        $vehicleHistoryRepository = $this->entityManager->getRepository('App:Historique');
        $history = $vehicleHistoryRepository->findBy(['vehicle' => $vehicle], ['date' => 'DESC']);

        // Log the retrieval of history
        $this->logger->info('Vehicle history retrieved.', [
            'vehicle_id' => $vehicle->getId(),
            'history_count' => count($history),
        ]);

        return $history;
    }

    public function gererBudgetVehicule(Vehicle $vehicle, float $expense): void
    {
        // Assuming the Vehicle entity has budget-related fields
        $budget = $vehicle->getBudget();
        $currentDepenses = $budget->getDepenses();
        $budget->setDepenses($currentDepenses + $expense);

        // Log the expense
        $this->logger->info("Expense of $expense applied to vehicle with ID {$vehicle->getId()}.");

        // Persist changes to the database
        $this->vehicleRepository->save($vehicle);
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

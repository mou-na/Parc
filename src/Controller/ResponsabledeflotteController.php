<?php

namespace App\Controller;

use App\Entity\Vehicle;
use App\Repository\ResponsabledeflotteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ResponsabledeflotteController extends AbstractController
{
    private $responsabledeflotterepository;

    public function __construct(ResponsabledeflotteRepository $responsabledeflotterepository)
    {
        $this->responsabledeflotterepository = $responsabledeflotterepository;
    }

    #[Route('/vehicule/{id}/historique', name: 'vehicule_historique')]
    public function suivreHistoriqueVehicule(Vehicle $vehicle): Response
    {
        $history = $this->responsabledeflotterepository->suivreHistoriqueVehicule($vehicle);

        return $this->render('vehicule/historique.html.twig', [
            'vehicle' => $vehicle,
            'history' => $history,
        ]);
    }
}

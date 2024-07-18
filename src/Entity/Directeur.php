<?php

namespace App\Entity;

use App\Repository\DirecteurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DirecteurRepository::class)]
class Directeur extends Utilisateur
{
    public function __construct()
    {
        parent::__construct();
        $this->setRole('ROLE_DIRECTEUR');
    }

    public function genererRapportsAnalyses(): void
    {
        // Logique pour générer des rapports et analyses
    }

    public function superviserVehicules(): void
    {
        // Logique pour superviser les véhicules
    }

    public function controlerEfficaciteGestion(): void
    {
        // Logique pour contrôler l'efficacité de la gestion
    }
}

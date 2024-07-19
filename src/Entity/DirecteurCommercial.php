<?php

namespace App\Entity;

use App\Repository\DirecteurCommercialRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DirecteurCommercialRepository::class)]
class DirecteurCommercial extends Utilisateur
{
    #[ORM\Column]
    private ?int $nombreLimiteVehicules = null;

    public function __construct()
    {
        parent::__construct();
        $this->setRole('ROLE_DIRECTEUR_COMMERCIAL');
    }

    public function getNombreLimiteVehicules(): ?int
    {
        return $this->nombreLimiteVehicules;
    }

    public function setNombreLimiteVehicules(int $nombreLimiteVehicules): static
    {
        $this->nombreLimiteVehicules = $nombreLimiteVehicules;

        return $this;
    }
}

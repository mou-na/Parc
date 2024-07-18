<?php

namespace App\Entity;

use App\Repository\ResponsabledeflotteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResponsabledeflotteRepository::class)]
class Responsabledeflotte extends Utilisateur
{
    public function __construct()
    {
        parent::__construct();
        $this->setRole('ROLE_RESPONSABLE_FLOTTE');
    }
}

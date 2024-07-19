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
}

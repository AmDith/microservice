<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role extends AbstractEntity
{

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nomRole = null;

    


    public function getNomRole(): ?string
    {
        return $this->nomRole;
    }

    public function setNomRole(?string $nomRole): static
    {
        $this->nomRole = $nomRole;

        return $this;
    }

   
}

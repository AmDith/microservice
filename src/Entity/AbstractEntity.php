<?php

namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
#[ORM\HasLifecycleCallbacks]
abstract class AbstractEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateCreate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateUpdate = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $usercreate = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $userupdate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->dateCreate;
    }

    public function setDateCreate(?\DateTimeInterface $dateCreate): static
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    public function getDateUpdate(): ?\DateTimeInterface
    {
        return $this->dateUpdate;
    }

    public function setDateUpdate(?\DateTimeInterface $dateUpdate): static
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }

    #[ORM\PrePersist]
    public function prePersist(): void
    {
        $now = new DateTime();
        $this->dateCreate = $now;
        $this->dateUpdate = $now;
    }

    #[ORM\PreUpdate]
    public function preUpdate(): void
    {
        $this->dateUpdate = new DateTime();
    }

    public function getUsercreate(): ?User
    {
        return $this->usercreate;
    }

    public function setUsercreate(?User $usercreate): static
    {
        $this->usercreate = $usercreate;

        return $this;
    }

    public function getUserupdate(): ?User
    {
        return $this->userupdate;
    }

    public function setUserupdate(?User $userupdate): static
    {
        $this->userupdate = $userupdate;

        return $this;
    }
}

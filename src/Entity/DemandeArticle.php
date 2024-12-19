<?php

namespace App\Entity;

use App\Repository\DemandeArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeArticleRepository::class)]
class DemandeArticle extends AbstractEntity
{

    #[ORM\Column(nullable: true)]
    private ?float $somme = null;

    #[ORM\Column(nullable: true)]
    private ?int $qteDemande = null;

    #[ORM\ManyToOne(inversedBy: 'demandeArticles')]
    private ?Demande $demande = null;

    #[ORM\ManyToOne(inversedBy: 'demandeArticles')]
    private ?Article $article = null;

    public function getSomme(): ?float
    {
        return $this->somme;
    }

    public function setSomme(?float $somme): static
    {
        $this->somme = $somme;

        return $this;
    }

    public function getQteDemande(): ?int
    {
        return $this->qteDemande;
    }

    public function setQteDemande(?int $qteDemande): static
    {
        $this->qteDemande = $qteDemande;

        return $this;
    }

    public function getDemande(): ?Demande
    {
        return $this->demande;
    }

    public function setDemande(?Demande $demande): static
    {
        $this->demande = $demande;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): static
    {
        $this->article = $article;

        return $this;
    }
}

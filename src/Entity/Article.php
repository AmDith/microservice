<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article extends AbstractEntity
{

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $libelle = null;

    #[ORM\Column(nullable: true)]
    private ?float $prix = null;

    #[ORM\Column(nullable: true)]
    private ?int $qteStock = null;

    /**
     * @var Collection<int, DemandeArticle>
     */
    #[ORM\OneToMany(targetEntity: DemandeArticle::class, mappedBy: 'article')]
    private Collection $demandeArticles;

    public function __construct()
    {
        $this->demandeArticles = new ArrayCollection();
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQteStock(): ?int
    {
        return $this->qteStock;
    }

    public function setQteStock(?int $qteStock): static
    {
        $this->qteStock = $qteStock;

        return $this;
    }

    /**
     * @return Collection<int, DemandeArticle>
     */
    public function getDemandeArticles(): Collection
    {
        return $this->demandeArticles;
    }

    public function addDemandeArticle(DemandeArticle $demandeArticle): static
    {
        if (!$this->demandeArticles->contains($demandeArticle)) {
            $this->demandeArticles->add($demandeArticle);
            $demandeArticle->setArticle($this);
        }

        return $this;
    }

    public function removeDemandeArticle(DemandeArticle $demandeArticle): static
    {
        if ($this->demandeArticles->removeElement($demandeArticle)) {
            // set the owning side to null (unless already changed)
            if ($demandeArticle->getArticle() === $this) {
                $demandeArticle->setArticle(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use App\Enum\EtatDeDemande;
use App\Repository\DemandeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeRepository::class)]
class Demande extends AbstractEntity
{
    
    #[ORM\Column(type: "string", enumType: EtatDeDemande::class)]
    private EtatDeDemande $etat = EtatDeDemande::ENCOURS;

    #[ORM\Column(nullable: true)]
    private ?float $montant = null;

    #[ORM\OneToOne(mappedBy: 'demande', cascade: ['persist', 'remove'])]
    private ?Dette $dette = null;

    /**
     * @var Collection<int, DemandeArticle>
     */
    #[ORM\OneToMany(targetEntity: DemandeArticle::class, mappedBy: 'demande')]
    private Collection $demandeArticles;

    #[ORM\ManyToOne(inversedBy: 'demandes')]
    private ?Client $client = null;

    public function __construct()
    {
        $this->demandeArticles = new ArrayCollection();
    }

    public function getEtat(): ?EtatDeDemande
    {
        return $this->etat;
    }

    public function setEtat(?EtatDeDemande $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(?float $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDette(): ?Dette
    {
        return $this->dette;
    }

    public function setDette(?Dette $dette): static
    {
        // unset the owning side of the relation if necessary
        if ($dette === null && $this->dette !== null) {
            $this->dette->setDemande(null);
        }

        // set the owning side of the relation if necessary
        if ($dette !== null && $dette->getDemande() !== $this) {
            $dette->setDemande($this);
        }

        $this->dette = $dette;

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
            $demandeArticle->setDemande($this);
        }

        return $this;
    }

    public function removeDemandeArticle(DemandeArticle $demandeArticle): static
    {
        if ($this->demandeArticles->removeElement($demandeArticle)) {
            // set the owning side to null (unless already changed)
            if ($demandeArticle->getDemande() === $this) {
                $demandeArticle->setDemande(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\CodeNatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CodeNatureRepository::class)
 */
class CodeNature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2, unique=true)
     */
    private $CodeNatureCompte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LibelleNatureCompte;

    /**
     * @ORM\OneToMany(targetEntity=Mouvement::class, mappedBy="NatureCompteLivreur")
     */
    private $mouvements;

    /**
     * @ORM\OneToMany(targetEntity=Mouvement::class, mappedBy="NatureCompteLivre")
     */
    private $mouvementl;

    /**
     * @ORM\OneToMany(targetEntity=Stock::class, mappedBy="NatureCompte")
     */
    private $stocks;

    public function __construct()
    {
        $this->mouvements = new ArrayCollection();
        $this->mouvementl = new ArrayCollection();
        $this->stocks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeNatureCompte(): ?string
    {
        return $this->CodeNatureCompte;
    }

    public function setCodeNatureCompte(string $CodeNatureCompte): self
    {
        $this->CodeNatureCompte = $CodeNatureCompte;

        return $this;
    }

    public function getLibelleNatureCompte(): ?string
    {
        return $this->LibelleNatureCompte;
    }

    public function setLibelleNatureCompte(string $LibelleNatureCompte): self
    {
        $this->LibelleNatureCompte = $LibelleNatureCompte;

        return $this;
    }

    /**
     * @return Collection|Mouvement[]
     */
    public function getMouvements(): Collection
    {
        return $this->mouvements;
    }

    public function addMouvement(Mouvement $mouvement): self
    {
        if (!$this->mouvements->contains($mouvement)) {
            $this->mouvements[] = $mouvement;
            $mouvement->setNatureCompteLivreur($this);
        }

        return $this;
    }

    public function removeMouvement(Mouvement $mouvement): self
    {
        if ($this->mouvements->removeElement($mouvement)) {
            // set the owning side to null (unless already changed)
            if ($mouvement->getNatureCompteLivreur() === $this) {
                $mouvement->setNatureCompteLivreur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Mouvement[]
     */
    public function getMouvementl(): Collection
    {
        return $this->mouvementl;
    }

    public function addMouvementl(Mouvement $mouvementl): self
    {
        if (!$this->mouvementl->contains($mouvementl)) {
            $this->mouvementl[] = $mouvementl;
            $mouvementl->setNatureCompteLivre($this);
        }

        return $this;
    }

    public function removeMouvementl(Mouvement $mouvementl): self
    {
        if ($this->mouvementl->removeElement($mouvementl)) {
            // set the owning side to null (unless already changed)
            if ($mouvementl->getNatureCompteLivre() === $this) {
                $mouvementl->setNatureCompteLivre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Stock[]
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): self
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks[] = $stock;
            $stock->setNatureCompte($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getNatureCompte() === $this) {
                $stock->setNatureCompte(null);
            }
        }

        return $this;
    }
}

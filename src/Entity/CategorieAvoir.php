<?php

namespace App\Entity;

use App\Repository\CategorieAvoirRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieAvoirRepository::class)
 */
class CategorieAvoir
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=3, unique=true)
     */
    private $CodeCatgorieAvoir;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LibelleCategorieAvoir;

    /**
     * @ORM\OneToMany(targetEntity=Mouvement::class, mappedBy="CategorieAvoirLivreur")
     */
    private $mouvements;

    /**
     * @ORM\OneToMany(targetEntity=Mouvement::class, mappedBy="CategorieAvoirLivre")
     */
    private $mouvementl;

    /**
     * @ORM\OneToMany(targetEntity=Stock::class, mappedBy="CategorieAvoir")
     */
    private $stocks;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateMaj;

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

    public function getCodeCatgorieAvoir(): ?string
    {
        return $this->CodeCatgorieAvoir;
    }

    public function setCodeCatgorieAvoir(string $CodeCatgorieAvoir): self
    {
        $this->CodeCatgorieAvoir = $CodeCatgorieAvoir;

        return $this;
    }

    public function getLibelleCategorieAvoir(): ?string
    {
        return $this->LibelleCategorieAvoir;
    }

    public function setLibelleCategorieAvoir(string $LibelleCategorieAvoir): self
    {
        $this->LibelleCategorieAvoir = $LibelleCategorieAvoir;

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
            $mouvement->setCategorieAvoirLivreur($this);
        }

        return $this;
    }

    public function removeMouvement(Mouvement $mouvement): self
    {
        if ($this->mouvements->removeElement($mouvement)) {
            // set the owning side to null (unless already changed)
            if ($mouvement->getCategorieAvoirLivreur() === $this) {
                $mouvement->setCategorieAvoirLivreur(null);
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
            $mouvementl->setCategorieAvoirLivre($this);
        }

        return $this;
    }

    public function removeMouvementl(Mouvement $mouvementl): self
    {
        if ($this->mouvementl->removeElement($mouvementl)) {
            // set the owning side to null (unless already changed)
            if ($mouvementl->getCategorieAvoirLivre() === $this) {
                $mouvementl->setCategorieAvoirLivre(null);
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
            $stock->setCategorieAvoir($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getCategorieAvoir() === $this) {
                $stock->setCategorieAvoir(null);
            }
        }

        return $this;
    }

    public function getDateMaj(): ?\DateTimeInterface
    {
        return $this->DateMaj;
    }

    public function setDateMaj(?\DateTimeInterface $DateMaj): self
    {
        $this->DateMaj = $DateMaj;

        return $this;
    }
}

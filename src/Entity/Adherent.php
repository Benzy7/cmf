<?php

namespace App\Entity;

use App\Repository\AdherentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdherentRepository::class)
 */
class Adherent
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
    private $CodeAdherent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomAdherent;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateMaj;

    /**
     * @ORM\ManyToOne(targetEntity=TypeAdherent::class, inversedBy="adherents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $TypeAdherent;

    /**
     * @ORM\OneToMany(targetEntity=Mouvement::class, mappedBy="CodeAdherentLivreur")
     */
    private $mouvements;

    /**
     * @ORM\OneToMany(targetEntity=Mouvement::class, mappedBy="CodeAdherentLivre")
     */
    private $mouvementl;

    /**
     * @ORM\OneToMany(targetEntity=Stock::class, mappedBy="CodeAdherent")
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

    public function getCodeAdherent(): ?string
    {
        return $this->CodeAdherent;
    }

    public function setCodeAdherent(string $CodeAdherent): self
    {
        $this->CodeAdherent = $CodeAdherent;

        return $this;
    }

    public function getNomAdherent(): ?string
    {
        return $this->NomAdherent;
    }

    public function setNomAdherent(string $NomAdherent): self
    {
        $this->NomAdherent = $NomAdherent;

        return $this;
    }

    public function getDateMaj(): ?\DateTimeInterface
    {
        return $this->dateMaj;
    }

    public function setDateMaj(?\DateTimeInterface $dateMaj): self
    {
        $this->dateMaj = $dateMaj;

        return $this;
    }

    public function getTypeAdherent(): ?TypeAdherent
    {
        return $this->TypeAdherent;
    }

    public function setTypeAdherent(?TypeAdherent $TypeAdherent): self
    {
        $this->TypeAdherent = $TypeAdherent;

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
            $mouvement->setCodeAdherentLivreur($this);
        }

        return $this;
    }

    public function removeMouvement(Mouvement $mouvement): self
    {
        if ($this->mouvements->removeElement($mouvement)) {
            // set the owning side to null (unless already changed)
            if ($mouvement->getCodeAdherentLivreur() === $this) {
                $mouvement->setCodeAdherentLivreur(null);
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
            $mouvementl->setCodeAdherentLivre($this);
        }

        return $this;
    }

    public function removeMouvementl(Mouvement $mouvementl): self
    {
        if ($this->mouvementl->removeElement($mouvementl)) {
            // set the owning side to null (unless already changed)
            if ($mouvementl->getCodeAdherentLivre() === $this) {
                $mouvementl->setCodeAdherentLivre(null);
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
            $stock->setCodeAdherent($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getCodeAdherent() === $this) {
                $stock->setCodeAdherent(null);
            }
        }

        return $this;
    }
}

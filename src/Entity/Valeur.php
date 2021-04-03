<?php

namespace App\Entity;

use App\Repository\ValeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ValeurRepository::class)
 */
class Valeur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10, unique=true)
     */
    private $CodeValeur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $LibelleValeur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Mnemonique;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $TypeValeur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NbTitresadmisBourse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NbCodFlott;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $GroupCotation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SuperSecteur;

    /**
     * @ORM\OneToMany(targetEntity=Mouvement::class, mappedBy="CodeValeur")
     */
    private $mouvements;

    /**
     * @ORM\OneToMany(targetEntity=Stock::class, mappedBy="CodeValeur")
     */
    private $stocks;

    /**
     * @ORM\OneToMany(targetEntity=Intermidiaire::class, mappedBy="Valeur")
     */
    private $intermidiaires;

    public function __construct()
    {
        $this->mouvements = new ArrayCollection();
        $this->stocks = new ArrayCollection();
        $this->intermidiaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeValeur(): ?string
    {
        return $this->CodeValeur;
    }

    public function setCodeValeur(string $CodeValeur): self
    {
        $this->CodeValeur = $CodeValeur;

        return $this;
    }

    public function getLibelleValeur(): ?string
    {
        return $this->LibelleValeur;
    }

    public function setLibelleValeur(?string $LibelleValeur): self
    {
        $this->LibelleValeur = $LibelleValeur;

        return $this;
    }

    public function getMnemonique(): ?string
    {
        return $this->Mnemonique;
    }

    public function setMnemonique(?string $Mnemonique): self
    {
        $this->Mnemonique = $Mnemonique;

        return $this;
    }

    public function getTypeValeur(): ?string
    {
        return $this->TypeValeur;
    }

    public function setTypeValeur(?string $TypeValeur): self
    {
        $this->TypeValeur = $TypeValeur;

        return $this;
    }

    public function getNbTitresadmisBourse(): ?string
    {
        return $this->NbTitresadmisBourse;
    }

    public function setNbTitresadmisBourse(?string $NbTitresadmisBourse): self
    {
        $this->NbTitresadmisBourse = $NbTitresadmisBourse;

        return $this;
    }

    public function getNbCodFlott(): ?string
    {
        return $this->NbCodFlott;
    }

    public function setNbCodFlott(?string $NbCodFlott): self
    {
        $this->NbCodFlott = $NbCodFlott;

        return $this;
    }

    public function getGroupCotation(): ?string
    {
        return $this->GroupCotation;
    }

    public function setGroupCotation(?string $GroupCotation): self
    {
        $this->GroupCotation = $GroupCotation;

        return $this;
    }

    public function getSuperSecteur(): ?string
    {
        return $this->SuperSecteur;
    }

    public function setSuperSecteur(?string $SuperSecteur): self
    {
        $this->SuperSecteur = $SuperSecteur;

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
            $mouvement->setCodeValeur($this);
        }

        return $this;
    }

    public function removeMouvement(Mouvement $mouvement): self
    {
        if ($this->mouvements->removeElement($mouvement)) {
            // set the owning side to null (unless already changed)
            if ($mouvement->getCodeValeur() === $this) {
                $mouvement->setCodeValeur(null);
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
            $stock->setCodeValeur($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getCodeValeur() === $this) {
                $stock->setCodeValeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Intermidiaire[]
     */
    public function getIntermidiaires(): Collection
    {
        return $this->intermidiaires;
    }

    public function addIntermidiaire(Intermidiaire $intermidiaire): self
    {
        if (!$this->intermidiaires->contains($intermidiaire)) {
            $this->intermidiaires[] = $intermidiaire;
            $intermidiaire->setValeur($this);
        }

        return $this;
    }

    public function removeIntermidiaire(Intermidiaire $intermidiaire): self
    {
        if ($this->intermidiaires->removeElement($intermidiaire)) {
            // set the owning side to null (unless already changed)
            if ($intermidiaire->getValeur() === $this) {
                $intermidiaire->setValeur(null);
            }
        }

        return $this;
    }
}

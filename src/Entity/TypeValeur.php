<?php

namespace App\Entity;

use App\Repository\TypeValeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeValeurRepository::class)
 */
class TypeValeur
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
    private $CodeTypeValeur;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $LibelleReduitTypeValeur;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $LibelleTypeValeur;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateMaj;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $TypeTitre;

    /**
     * @ORM\OneToMany(targetEntity=Valeur::class, mappedBy="TypeValeur")
     */
    private $valeurs;

    public function __construct()
    {
        $this->valeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeTypeValeur(): ?string
    {
        return $this->CodeTypeValeur;
    }

    public function setCodeTypeValeur(string $CodeTypeValeur): self
    {
        $this->CodeTypeValeur = $CodeTypeValeur;

        return $this;
    }

    public function getLibelleReduitTypeValeur(): ?string
    {
        return $this->LibelleReduitTypeValeur;
    }

    public function setLibelleReduitTypeValeur(string $LibelleReduitTypeValeur): self
    {
        $this->LibelleReduitTypeValeur = $LibelleReduitTypeValeur;

        return $this;
    }

    public function getLibelleTypeValeur(): ?string
    {
        return $this->LibelleTypeValeur;
    }

    public function setLibelleTypeValeur(string $LibelleTypeValeur): self
    {
        $this->LibelleTypeValeur = $LibelleTypeValeur;

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

    public function getTypeTitre(): ?string
    {
        return $this->TypeTitre;
    }

    public function setTypeTitre(?string $TypeTitre): self
    {
        $this->TypeTitre = $TypeTitre;

        return $this;
    }

    /**
     * @return Collection|Valeur[]
     */
    public function getValeurs(): Collection
    {
        return $this->valeurs;
    }

    public function addValeur(Valeur $valeur): self
    {
        if (!$this->valeurs->contains($valeur)) {
            $this->valeurs[] = $valeur;
            $valeur->setTypeValeur($this);
        }

        return $this;
    }

    public function removeValeur(Valeur $valeur): self
    {
        if ($this->valeurs->removeElement($valeur)) {
            // set the owning side to null (unless already changed)
            if ($valeur->getTypeValeur() === $this) {
                $valeur->setTypeValeur(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\CodeMarcheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CodeMarcheRepository::class)
 */
class CodeMarche
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
    private $CodeMarche;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LibelleMarche;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateMaj;

    /**
     * @ORM\OneToMany(targetEntity=Intermidiaire::class, mappedBy="Marche")
     */
    private $intermidiaires;

    public function __construct()
    {
        $this->intermidiaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeMarche(): ?string
    {
        return $this->CodeMarche;
    }

    public function setCodeMarche(string $CodeMarche): self
    {
        $this->CodeMarche = $CodeMarche;

        return $this;
    }

    public function getLibelleMarche(): ?string
    {
        return $this->LibelleMarche;
    }

    public function setLibelleMarche(string $LibelleMarche): self
    {
        $this->LibelleMarche = $LibelleMarche;

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
            $intermidiaire->setMarche($this);
        }

        return $this;
    }

    public function removeIntermidiaire(Intermidiaire $intermidiaire): self
    {
        if ($this->intermidiaires->removeElement($intermidiaire)) {
            // set the owning side to null (unless already changed)
            if ($intermidiaire->getMarche() === $this) {
                $intermidiaire->setMarche(null);
            }
        }

        return $this;
    }
}

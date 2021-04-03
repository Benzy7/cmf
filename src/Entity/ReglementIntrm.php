<?php

namespace App\Entity;

use App\Repository\ReglementIntrmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReglementIntrmRepository::class)
 */
class ReglementIntrm
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1, unique=true)
     */
    private $CodeReg;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateMaj;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LibelleReg;

    /**
     * @ORM\OneToMany(targetEntity=Intermidiaire::class, mappedBy="Reglement")
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

    public function getCodeReg(): ?string
    {
        return $this->CodeReg;
    }

    public function setCodeReg(string $CodeReg): self
    {
        $this->CodeReg = $CodeReg;

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

    public function getLibelleReg(): ?string
    {
        return $this->LibelleReg;
    }

    public function setLibelleReg(string $LibelleReg): self
    {
        $this->LibelleReg = $LibelleReg;

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
            $intermidiaire->setReglement($this);
        }

        return $this;
    }

    public function removeIntermidiaire(Intermidiaire $intermidiaire): self
    {
        if ($this->intermidiaires->removeElement($intermidiaire)) {
            // set the owning side to null (unless already changed)
            if ($intermidiaire->getReglement() === $this) {
                $intermidiaire->setReglement(null);
            }
        }

        return $this;
    }
}

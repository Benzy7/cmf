<?php

namespace App\Entity;

use App\Repository\CodeProfitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CodeProfitRepository::class)
 */
class CodeProfit
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
    private $CodeProfit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LibelleProfit;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateMaj;

    /**
     * @ORM\OneToMany(targetEntity=Intermidiaire::class, mappedBy="Profit")
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

    public function getCodeProfit(): ?string
    {
        return $this->CodeProfit;
    }

    public function setCodeProfit(string $CodeProfit): self
    {
        $this->CodeProfit = $CodeProfit;

        return $this;
    }

    public function getLibelleProfit(): ?string
    {
        return $this->LibelleProfit;
    }

    public function setLibelleProfit(string $LibelleProfit): self
    {
        $this->LibelleProfit = $LibelleProfit;

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
            $intermidiaire->setProfit($this);
        }

        return $this;
    }

    public function removeIntermidiaire(Intermidiaire $intermidiaire): self
    {
        if ($this->intermidiaires->removeElement($intermidiaire)) {
            // set the owning side to null (unless already changed)
            if ($intermidiaire->getProfit() === $this) {
                $intermidiaire->setProfit(null);
            }
        }

        return $this;
    }
}

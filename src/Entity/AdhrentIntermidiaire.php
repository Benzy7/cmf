<?php

namespace App\Entity;

use App\Repository\AdhrentIntermidiaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdhrentIntermidiaireRepository::class)
 */
class AdhrentIntermidiaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Adherent::class)
     * @ORM\JoinColumn(nullable=false)
     * @ORM\OrderBy({"NomAdherent" = "DESC"})
     */
    private $CodeInterm;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $LibelleSigle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $LibelleReduit;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateCult;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateMaj;

    /**
     * @ORM\OneToMany(targetEntity=Orders::class, mappedBy="CodeAdi")
     */
    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeInterm(): ?Adherent
    {
        return $this->CodeInterm;
    }

    public function setCodeInterm(Adherent $CodeInterm): self
    {
        $this->CodeInterm = $CodeInterm;

        return $this;
    }

    public function getLibelleSigle(): ?string
    {
        return $this->LibelleSigle;
    }

    public function setLibelleSigle(?string $LibelleSigle): self
    {
        $this->LibelleSigle = $LibelleSigle;

        return $this;
    }

    public function getLibelleReduit(): ?string
    {
        return $this->LibelleReduit;
    }

    public function setLibelleReduit(?string $LibelleReduit): self
    {
        $this->LibelleReduit = $LibelleReduit;

        return $this;
    }

    public function getDateCult(): ?\DateTimeInterface
    {
        return $this->DateCult;
    }

    public function setDateCult(?\DateTimeInterface $DateCult): self
    {
        $this->DateCult = $DateCult;

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
     * @return Collection|Orders[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Orders $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setCodeAdi($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getCodeAdi() === $this) {
                $order->setCodeAdi(null);
            }
        }

        return $this;
    }
}

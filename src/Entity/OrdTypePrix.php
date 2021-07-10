<?php

namespace App\Entity;

use App\Repository\OrdTypePrixRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdTypePrixRepository::class)
 */
class OrdTypePrix
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
    private $CodeTypePrix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LibTypePrix;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateMaj;

    /**
     * @ORM\OneToMany(targetEntity=Orders::class, mappedBy="TypePrixOrd")
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

    public function getCodeTypePrix(): ?string
    {
        return $this->CodeTypePrix;
    }

    public function setCodeTypePrix(string $CodeTypePrix): self
    {
        $this->CodeTypePrix = $CodeTypePrix;

        return $this;
    }

    public function getLibTypePrix(): ?string
    {
        return $this->LibTypePrix;
    }

    public function setLibTypePrix(string $LibTypePrix): self
    {
        $this->LibTypePrix = $LibTypePrix;

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
            $order->setTypePrixOrd($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getTypePrixOrd() === $this) {
                $order->setTypePrixOrd(null);
            }
        }

        return $this;
    }
}

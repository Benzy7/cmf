<?php

namespace App\Entity;

use App\Repository\OrdStatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdStatRepository::class)
 */
class OrdStat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1, nullable=true, unique=true)
     */
    private $CodeStatOrd;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LibStatOrdd;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateMaj;

    /**
     * @ORM\OneToMany(targetEntity=Orders::class, mappedBy="StatOrd")
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

    public function getCodeStatOrd(): ?string
    {
        return $this->CodeStatOrd;
    }

    public function setCodeStatOrd(?string $CodeStatOrd): self
    {
        $this->CodeStatOrd = $CodeStatOrd;

        return $this;
    }

    public function getLibStatOrdd(): ?string
    {
        return $this->LibStatOrdd;
    }

    public function setLibStatOrdd(string $LibStatOrdd): self
    {
        $this->LibStatOrdd = $LibStatOrdd;

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
            $order->setStatOrd($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getStatOrd() === $this) {
                $order->setStatOrd(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\OrdTypeVldRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdTypeVldRepository::class)
 */
class OrdTypeVld
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
    private $CodeTypeVld;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LibTypeVld;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateMaj;

    /**
     * @ORM\OneToMany(targetEntity=Orders::class, mappedBy="TypeVldOrd")
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

    public function getCodeTypeVld(): ?string
    {
        return $this->CodeTypeVld;
    }

    public function setCodeTypeVld(string $CodeTypeVld): self
    {
        $this->CodeTypeVld = $CodeTypeVld;

        return $this;
    }

    public function getLibTypeVld(): ?string
    {
        return $this->LibTypeVld;
    }

    public function setLibTypeVld(string $LibTypeVld): self
    {
        $this->LibTypeVld = $LibTypeVld;

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
            $order->setTypeVldOrd($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getTypeVldOrd() === $this) {
                $order->setTypeVldOrd(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\TypeAdherentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeAdherentRepository::class)
 */
class TypeAdherent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $CodeTypeAdherent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LibelleTypeAdherent;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateMaj;

    /**
     * @ORM\OneToMany(targetEntity=Adherent::class, mappedBy="TypeAdherent", orphanRemoval=true)
     */
    private $adherents;

    public function __construct()
    {
        $this->adherents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeTypeAdherent(): ?string
    {
        return $this->CodeTypeAdherent;
    }

    public function setCodeTypeAdherent(string $CodeTypeAdherent): self
    {
        $this->CodeTypeAdherent = $CodeTypeAdherent;

        return $this;
    }

    public function getLibelleTypeAdherent(): ?string
    {
        return $this->LibelleTypeAdherent;
    }

    public function setLibelleTypeAdherent(string $LibelleTypeAdherent): self
    {
        $this->LibelleTypeAdherent = $LibelleTypeAdherent;

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
     * @return Collection|Adherent[]
     */
    public function getAdherents(): Collection
    {
        return $this->adherents;
    }

    public function addAdherent(Adherent $adherent): self
    {
        if (!$this->adherents->contains($adherent)) {
            $this->adherents[] = $adherent;
            $adherent->setTypeAdherent($this);
        }

        return $this;
    }

    public function removeAdherent(Adherent $adherent): self
    {
        if ($this->adherents->removeElement($adherent)) {
            // set the owning side to null (unless already changed)
            if ($adherent->getTypeAdherent() === $this) {
                $adherent->setTypeAdherent(null);
            }
        }

        return $this;
    }
}

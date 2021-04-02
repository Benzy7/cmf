<?php

namespace App\Entity;

use App\Repository\CodeTitreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CodeTitreRepository::class)
 */
class CodeTitre
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
    private $CodeTitre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LibelleTitre;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateMaj;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeTitre(): ?string
    {
        return $this->CodeTitre;
    }

    public function setCodeTitre(string $CodeTitre): self
    {
        $this->CodeTitre = $CodeTitre;

        return $this;
    }

    public function getLibelleTitre(): ?string
    {
        return $this->LibelleTitre;
    }

    public function setLibelleTitre(string $LibelleTitre): self
    {
        $this->LibelleTitre = $LibelleTitre;

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
}

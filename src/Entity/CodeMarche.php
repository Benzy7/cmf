<?php

namespace App\Entity;

use App\Repository\CodeMarcheRepository;
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
}

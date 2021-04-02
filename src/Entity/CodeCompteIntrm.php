<?php

namespace App\Entity;

use App\Repository\CodeCompteIntrmRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CodeCompteIntrmRepository::class)
 */
class CodeCompteIntrm
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
    private $CodeCompte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LibelleCompte;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateMaj;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCompte(): ?string
    {
        return $this->CodeCompte;
    }

    public function setCodeCompte(string $CodeCompte): self
    {
        $this->CodeCompte = $CodeCompte;

        return $this;
    }

    public function getLibelleCompte(): ?string
    {
        return $this->LibelleCompte;
    }

    public function setLibelleCompte(string $LibelleCompte): self
    {
        $this->LibelleCompte = $LibelleCompte;

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

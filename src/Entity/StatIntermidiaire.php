<?php

namespace App\Entity;

use App\Repository\StatIntermidiaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatIntermidiaireRepository::class)
 */
class StatIntermidiaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomFicher;

    /**
     * @ORM\Column(type="date")
     */
    private $DateChrg;

    /**
     * @ORM\Column(type="time")
     */
    private $HeureChrg;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateTransaction;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Etat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $RemarqueMotif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFicher(): ?string
    {
        return $this->NomFicher;
    }

    public function setNomFicher(string $NomFicher): self
    {
        $this->NomFicher = $NomFicher;

        return $this;
    }

    public function getDateChrg(): ?\DateTimeInterface
    {
        return $this->DateChrg;
    }

    public function setDateChrg(\DateTimeInterface $DateChrg): self
    {
        $this->DateChrg = $DateChrg;

        return $this;
    }

    public function getHeureChrg(): ?\DateTimeInterface
    {
        return $this->HeureChrg;
    }

    public function setHeureChrg(\DateTimeInterface $HeureChrg): self
    {
        $this->HeureChrg = $HeureChrg;

        return $this;
    }

    public function getDateTransaction(): ?\DateTimeInterface
    {
        return $this->DateTransaction;
    }

    public function setDateTransaction(?\DateTimeInterface $DateTransaction): self
    {
        $this->DateTransaction = $DateTransaction;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->Etat;
    }

    public function setEtat(string $Etat): self
    {
        $this->Etat = $Etat;

        return $this;
    }

    public function getRemarqueMotif(): ?string
    {
        return $this->RemarqueMotif;
    }

    public function setRemarqueMotif(?string $RemarqueMotif): self
    {
        $this->RemarqueMotif = $RemarqueMotif;

        return $this;
    }
}

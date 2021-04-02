<?php

namespace App\Entity;

use App\Repository\ReglementIntrmRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReglementIntrmRepository::class)
 */
class ReglementIntrm
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
    private $CodeReg;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateMaj;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LibelleReg;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeReg(): ?string
    {
        return $this->CodeReg;
    }

    public function setCodeReg(string $CodeReg): self
    {
        $this->CodeReg = $CodeReg;

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

    public function getLibelleReg(): ?string
    {
        return $this->LibelleReg;
    }

    public function setLibelleReg(string $LibelleReg): self
    {
        $this->LibelleReg = $LibelleReg;

        return $this;
    }
}

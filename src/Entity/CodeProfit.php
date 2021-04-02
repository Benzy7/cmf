<?php

namespace App\Entity;

use App\Repository\CodeProfitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CodeProfitRepository::class)
 */
class CodeProfit
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
    private $CodeProfit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LibelleProfit;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateMaj;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeProfit(): ?string
    {
        return $this->CodeProfit;
    }

    public function setCodeProfit(string $CodeProfit): self
    {
        $this->CodeProfit = $CodeProfit;

        return $this;
    }

    public function getLibelleProfit(): ?string
    {
        return $this->LibelleProfit;
    }

    public function setLibelleProfit(string $LibelleProfit): self
    {
        $this->LibelleProfit = $LibelleProfit;

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

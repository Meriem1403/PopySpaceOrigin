<?php

namespace App\Entity;

use App\Repository\VoyageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: VoyageRepository::class)]
class Voyage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[NotBlank]
    private ?Planete $planete = null;

    #[ORM\Column(length: 255)]
    #[NotBlank]
    #[Length(min: 3, max: 255)]
    private ?string $objectif = null;

    #[ORM\Column]
    private bool $upgradeTrouDeVer = false;

    #[ORM\Column]
    #[NotBlank]
    private ?\DateTimeImmutable $depart;

    public function __construct()
    {
        $this->depart = new \DateTimeImmutable('+1 month');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlanete(): ?Planete
    {
        return $this->planete;
    }

    public function setPlanete(?Planete $planete): static
    {
        $this->planete = $planete;

        return $this;
    }

    public function getObjectif(): ?string
    {
        return $this->objectif;
    }

    public function setObjectif(?string $objectif): static
    {
        $this->objectif = $objectif;

        return $this;
    }

    public function getDepart(): ?\DateTimeImmutable
    {
        return $this->depart;
    }

    public function setDepart(?\DateTimeImmutable $depart): static
    {
        $this->depart = $depart;

        return $this;
    }

    public function getUpgradeTrouDeVer(): bool
    {
        return $this->upgradeTrouDeVer;
    }

    public function setUpgradeTrouDeVer(?bool $upgradeTrouDeVer): self
    {
        $this->upgradeTrouDeVer = (bool) $upgradeTrouDeVer;

        return $this;
    }

    public function isUpgradeTrouDeVer(): ?bool
    {
        return $this->upgradeTrouDeVer;
    }
}

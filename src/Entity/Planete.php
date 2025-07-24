<?php

namespace App\Entity;

use App\Repository\PlaneteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: PlaneteRepository::class)]
class Planete
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[NotBlank]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    #[NotBlank]
    private ?string $description = null;

    #[ORM\Column]
    #[NotBlank]
    #[GreaterThanOrEqual(0)]
    private ?float $distanceLumiereTerre = null;

    #[ORM\Column()]
    #[NotBlank]
    private ?string $image = null;

    #[ORM\Column]
    private bool $dansVoieLactee = true;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDistanceLumiereTerre(): ?float
    {
        return $this->distanceLumiereTerre;
    }

    public function setDistanceLumiereTerre(?float $distanceLumiereTerre): static
    {
        $this->distanceLumiereTerre = $distanceLumiereTerre;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function isDansVoieLactee(): bool
    {
        return $this->dansVoieLactee;
    }

    public function setDansVoieLactee(bool $dansVoieLactee): self
    {
        $this->dansVoieLactee = $dansVoieLactee;

        return $this;
    }
}

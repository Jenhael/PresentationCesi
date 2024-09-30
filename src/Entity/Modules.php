<?php

namespace App\Entity;

use App\Repository\ModulesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModulesRepository::class)]
class Modules
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_formation = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $duree = null;

    #[ORM\ManyToOne(inversedBy: 'module')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PositionIntervenant $positionIntervenant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdFormation(): ?int
    {
        return $this->id_formation;
    }

    public function setIdFormation(int $id_formation): static
    {
        $this->id_formation = $id_formation;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getPositionIntervenant(): ?PositionIntervenant
    {
        return $this->positionIntervenant;
    }

    public function setPositionIntervenant(?PositionIntervenant $positionIntervenant): static
    {
        $this->positionIntervenant = $positionIntervenant;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\DiplomeIntervenantsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiplomeIntervenantsRepository::class)]
class DiplomeIntervenants
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_intervenant = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_diplome = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdIntervenant(): ?int
    {
        return $this->id_intervenant;
    }

    public function setIdIntervenant(int $id_intervenant): static
    {
        $this->id_intervenant = $id_intervenant;

        return $this;
    }

    public function getNomDiplome(): ?string
    {
        return $this->nom_diplome;
    }

    public function setNomDiplome(string $nom_diplome): static
    {
        $this->nom_diplome = $nom_diplome;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\FormationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationsRepository::class)]
class Formations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $formation = null;

    #[ORM\ManyToMany(targetEntity: Utilisateur::class, inversedBy: 'formations')]
    private Collection $formation_relation;

    #[ORM\ManyToOne(inversedBy: 'formation')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PositionIntervenant $positionIntervenant = null;

    public function __construct()
    {
        $this->formation_relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormation(): ?string
    {
        return $this->formation;
    }

    public function setFormation(string $formation): static
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getFormationRelation(): Collection
    {
        return $this->formation_relation;
    }

    public function addFormationRelation(Utilisateur $formationRelation): static
    {
        if (!$this->formation_relation->contains($formationRelation)) {
            $this->formation_relation->add($formationRelation);
        }

        return $this;
    }

    public function removeFormationRelation(Utilisateur $formationRelation): static
    {
        $this->formation_relation->removeElement($formationRelation);

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

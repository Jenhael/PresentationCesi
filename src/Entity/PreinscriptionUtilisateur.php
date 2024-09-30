<?php

namespace App\Entity;

use App\Repository\PreinscriptionUtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PreinscriptionUtilisateurRepository::class)]
class PreinscriptionUtilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_utilisateur = null;

    #[ORM\Column]
    private ?int $id_formation = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\ManyToMany(targetEntity: Utilisateur::class, inversedBy: 'preinscriptionUtilisateurs')]
    private Collection $PreinscriptionUtilisateurRelation;

    public function __construct()
    {
        $this->PreinscriptionUtilisateurRelation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUtilisateur(): ?int
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(int $id_utilisateur): static
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
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

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getPreinscriptionUtilisateurRelation(): Collection
    {
        return $this->PreinscriptionUtilisateurRelation;
    }

    public function addPreinscriptionUtilisateurRelation(Utilisateur $preinscriptionUtilisateurRelation): static
    {
        if (!$this->PreinscriptionUtilisateurRelation->contains($preinscriptionUtilisateurRelation)) {
            $this->PreinscriptionUtilisateurRelation->add($preinscriptionUtilisateurRelation);
        }

        return $this;
    }

    public function removePreinscriptionUtilisateurRelation(Utilisateur $preinscriptionUtilisateurRelation): static
    {
        $this->PreinscriptionUtilisateurRelation->removeElement($preinscriptionUtilisateurRelation);

        return $this;
    }
}

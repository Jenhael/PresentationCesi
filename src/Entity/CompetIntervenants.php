<?php

namespace App\Entity;

use App\Repository\CompetIntervenantsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetIntervenantsRepository::class)]
class CompetIntervenants
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_intervenant = null;

    #[ORM\Column]
    private ?int $id_competances = null;

    /**
     * @var Collection<int, InscriptionIntervenant>
     */
    #[ORM\ManyToMany(targetEntity: InscriptionIntervenant::class, inversedBy: 'competIntervenants')]
    private Collection $competances;

    public function __construct()
    {
        $this->competances = new ArrayCollection();
    }

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

    public function getIdCompetances(): ?int
    {
        return $this->id_competances;
    }

    public function setIdCompetances(int $id_competances): static
    {
        $this->id_competances = $id_competances;

        return $this;
    }

    /**
     * @return Collection<int, InscriptionIntervenant>
     */
    public function getCompetances(): Collection
    {
        return $this->competances;
    }

    public function addCompetance(InscriptionIntervenant $competance): static
    {
        if (!$this->competances->contains($competance)) {
            $this->competances->add($competance);
        }

        return $this;
    }

    public function removeCompetance(InscriptionIntervenant $competance): static
    {
        $this->competances->removeElement($competance);

        return $this;
    }
}

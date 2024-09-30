<?php

namespace App\Entity;

use App\Repository\CompetancesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetancesRepository::class)]
class Competances
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToMany(targetEntity: InscriptionIntervenant::class, inversedBy: 'competances')]
    private Collection $inscriptionIntervenants;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'competances')]
    private Collection $competances_relation;

    public function __construct()
    {
        $this->inscriptionIntervenants = new ArrayCollection();
        $this->competances_relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, InscriptionIntervenant>
     */
    public function getCompetances(): Collection
    {
        return $this->inscriptionIntervenants;
    }

    public function addCompetance(InscriptionIntervenant $competance): static
    {
        if (!$this->inscriptionIntervenants->contains($competance)) {
            $this->inscriptionIntervenants->add($competance);
            $competance->addCompetance($this);
        }

        return $this;
    }

    public function removeCompetance(InscriptionIntervenant $competance): static
    {
        if ($this->inscriptionIntervenants->removeElement($competance)) {
            $competance->removeCompetance($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getCompetancesRelation(): Collection
    {
        return $this->competances_relation;
    }

    public function addCompetancesRelation(User $competancesRelation): static
    {
        if (!$this->competances_relation->contains($competancesRelation)) {
            $this->competances_relation->add($competancesRelation);
        }

        return $this;
    }

    public function removeCompetancesRelation(User $competancesRelation): static
    {
        $this->competances_relation->removeElement($competancesRelation);

        return $this;
    }
}

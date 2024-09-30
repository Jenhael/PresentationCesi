<?php

namespace App\Entity;

use App\Repository\PositionIntervenantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PositionIntervenantRepository::class)]
class PositionIntervenant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_intervenant = null;

    #[ORM\Column]
    private ?int $id_formation = null;

    #[ORM\Column]
    private ?int $id_module = null;

    /**
     * @var Collection<int, Formations>
     */
    #[ORM\OneToMany(targetEntity: Formations::class, mappedBy: 'positionIntervenant')]
    private Collection $formation;

    /**
     * @var Collection<int, Modules>
     */
    #[ORM\OneToMany(targetEntity: Modules::class, mappedBy: 'positionIntervenant')]
    private Collection $module;

    public function __construct()
    {
        $this->formation = new ArrayCollection();
        $this->module = new ArrayCollection();
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

    public function getIdFormation(): ?int
    {
        return $this->id_formation;
    }

    public function setIdFormation(int $id_formation): static
    {
        $this->id_formation = $id_formation;

        return $this;
    }

    public function getIdModule(): ?int
    {
        return $this->id_module;
    }

    public function setIdModule(int $id_module): static
    {
        $this->id_module = $id_module;

        return $this;
    }

    /**
     * @return Collection<int, Formations>
     */
    public function getFormation(): Collection
    {
        return $this->formation;
    }

    public function addFormation(Formations $formation): static
    {
        if (!$this->formation->contains($formation)) {
            $this->formation->add($formation);
            $formation->setPositionIntervenant($this);
        }

        return $this;
    }

    public function removeFormation(Formations $formation): static
    {
        if ($this->formation->removeElement($formation)) {
            // set the owning side to null (unless already changed)
            if ($formation->getPositionIntervenant() === $this) {
                $formation->setPositionIntervenant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Modules>
     */
    public function getModule(): Collection
    {
        return $this->module;
    }

    public function addModule(Modules $module): static
    {
        if (!$this->module->contains($module)) {
            $this->module->add($module);
            $module->setPositionIntervenant($this);
        }

        return $this;
    }

    public function removeModule(Modules $module): static
    {
        if ($this->module->removeElement($module)) {
            // set the owning side to null (unless already changed)
            if ($module->getPositionIntervenant() === $this) {
                $module->setPositionIntervenant(null);
            }
        }

        return $this;
    }
}

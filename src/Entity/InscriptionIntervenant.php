<?php

namespace App\Entity;

use App\Repository\InscriptionIntervenantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionIntervenantRepository::class)]
class InscriptionIntervenant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $civilite = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $date_de_naissance = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $code_postal = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\ManyToMany(targetEntity: Competances::class, mappedBy: 'inscriptionIntervenants')]
    private Collection $competances;

    #[ORM\OneToOne(mappedBy: 'user_relation', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    /**
     * @var Collection<int, CompetIntervenants>
     */
    #[ORM\ManyToMany(targetEntity: CompetIntervenants::class, mappedBy: 'competances')]
    private Collection $competIntervenants;

    public function __construct()
    {
        $this->competances = new ArrayCollection();
        $this->competIntervenants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(string $civilite): static
    {
        $this->civilite = $civilite;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateDeNaissance(): ?string
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(string $date_de_naissance): static
    {
        $this->date_de_naissance = $date_de_naissance;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostale(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostale(string $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection<int, Competances>
     */
    public function getCompetances(): Collection
    {
        return $this->competances;
    }

    public function addCompetance(Competances $competance): static
    {
        if (!$this->competances->contains($competance)) {
            $this->competances->add($competance);
        }

        return $this;
    }

    public function removeCompetance(Competances $competance): static
    {
        $this->competances->removeElement($competance);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        // set the owning side of the relation if necessary
        if ($user->getUserRelation() !== $this) {
            $user->setUserRelation($this);
        }

        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, CompetIntervenants>
     */
    public function getCompetIntervenants(): Collection
    {
        return $this->competIntervenants;
    }

    public function addCompetIntervenant(CompetIntervenants $competIntervenant): static
    {
        if (!$this->competIntervenants->contains($competIntervenant)) {
            $this->competIntervenants->add($competIntervenant);
            $competIntervenant->addCompetance($this);
        }

        return $this;
    }

    public function removeCompetIntervenant(CompetIntervenants $competIntervenant): static
    {
        if ($this->competIntervenants->removeElement($competIntervenant)) {
            $competIntervenant->removeCompetance($this);
        }

        return $this;
    }
}

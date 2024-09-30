<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
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
    private ?string $diplome = null;

    #[ORM\Column(length: 255)]
    private ?string $pays = null;

    #[ORM\Column(length: 255)]
    private ?string $cv = null;

    #[ORM\ManyToMany(targetEntity: Formations::class, mappedBy: 'formation_relation')]
    private Collection $formations;

    #[ORM\ManyToMany(targetEntity: PreinscriptionUtilisateur::class, mappedBy: 'PreinscriptionUtilisateurRelation')]
    private Collection $preinscriptionUtilisateurs;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
        $this->preinscriptionUtilisateurs = new ArrayCollection();
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

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): static
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

    public function getDiplome(): ?string
    {
        return $this->diplome;
    }

    public function setDiplome(string $diplome): static
    {
        $this->diplome = $diplome;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): static
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * @return Collection<int, Formations>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formations $formation): static
    {
        if (!$this->formations->contains($formation)) {
            $this->formations->add($formation);
            $formation->addFormationRelation($this);
        }

        return $this;
    }

    public function removeFormation(Formations $formation): static
    {
        if ($this->formations->removeElement($formation)) {
            $formation->removeFormationRelation($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, PreinscriptionUtilisateur>
     */
    public function getPreinscriptionUtilisateurs(): Collection
    {
        return $this->preinscriptionUtilisateurs;
    }

    public function addPreinscriptionUtilisateur(PreinscriptionUtilisateur $preinscriptionUtilisateur): static
    {
        if (!$this->preinscriptionUtilisateurs->contains($preinscriptionUtilisateur)) {
            $this->preinscriptionUtilisateurs->add($preinscriptionUtilisateur);
            $preinscriptionUtilisateur->addPreinscriptionUtilisateurRelation($this);
        }

        return $this;
    }

    public function removePreinscriptionUtilisateur(PreinscriptionUtilisateur $preinscriptionUtilisateur): static
    {
        if ($this->preinscriptionUtilisateurs->removeElement($preinscriptionUtilisateur)) {
            $preinscriptionUtilisateur->removePreinscriptionUtilisateurRelation($this);
        }

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
}

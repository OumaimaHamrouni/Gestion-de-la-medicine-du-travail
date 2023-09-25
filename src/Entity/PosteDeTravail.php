<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PosteDeTravailRepository")
 */
class PosteDeTravail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\Column(type="string", length=50)

     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255,unique=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le nom de l'entreprise doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'entreprise doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $refrence;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Salarie", mappedBy="ID_PT")
     */
    private $salaries;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Le nom de l'entreprise doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'entreprise doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $lieu;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)

     */
    private $atelier;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)

     */
    private $exigence;

    /**
     * @ORM\Column(type="string", length=255)

     * )
     */
    private $horaire;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)

     */
    private $moyen_maitrise;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $equipement = [];



    public function __construct()
    {
        $this->salaries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getRefrence(): ?string
    {
        return $this->refrence;
    }

    public function setRefrence(string $refrence): self
    {
        $this->refrence = $refrence;

        return $this;
    }

    /**
     * @return Collection|Salarie[]
     */
    public function getSalaries(): Collection
    {
        return $this->salaries;
    }

    public function addSalary(Salarie $salary): self
    {
        if (!$this->salaries->contains($salary)) {
            $this->salaries[] = $salary;
            $salary->setIDPT($this);
        }

        return $this;
    }

    public function removeSalary(Salarie $salary): self
    {
        if ($this->salaries->contains($salary)) {
            $this->salaries->removeElement($salary);
            // set the owning side to null (unless already changed)
            if ($salary->getIDPT() === $this) {
                $salary->setIDPT(null);
            }
        }

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getAtelier(): ?string
    {
        return $this->atelier;
    }

    public function setAtelier(string $atelier): self
    {
        $this->atelier = $atelier;

        return $this;
    }

    public function getExigence(): ?string
    {
        return $this->exigence;
    }

    public function setExigence(string $exigence): self
    {
        $this->exigence = $exigence;

        return $this;
    }

    public function getHoraire(): ?string
    {
        return $this->horaire;
    }

    public function setHoraire(string $horaire): self
    {
        $this->horaire = $horaire;

        return $this;
    }

    public function getMoyenMaitrise(): ?string
    {
        return $this->moyen_maitrise;
    }

    public function setMoyenMaitrise(string $moyen_maitrise): self
    {
        $this->moyen_maitrise = $moyen_maitrise;

        return $this;
    }

    public function getEquipement(): ?array
    {
        return $this->equipement;
    }

    public function setEquipement(?array $equipement): self
    {
        $this->equipement = $equipement;

        return $this;
    }




}

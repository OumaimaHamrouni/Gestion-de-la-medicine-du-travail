<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\SalarieRepository")
 */
class Salarie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="matricule",type="string", length=50,unique=true)
     *   * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Le nom de l'entreprise doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'entreprise doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=50)
     *   * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Le nom de l'entreprise doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'entreprise doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     *   * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Le nom de l'entreprise doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'entreprise doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50)
     *   * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Le nom de l'entreprise doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'entreprise doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=20)
     *   * @Assert\Length(
     *      min = 7,
     *      max = 50,
     *      minMessage = "Le nom de l'entreprise doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'entreprise doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $tel;

    /**
     * @ORM\Column(type="date")
     */
    private $date_de_naissance;



    /**
     * @ORM\Column(type="string", length=50)
     *   * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Le nom de l'entreprise doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'entreprise doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PosteDeTravail", inversedBy="salaries")
     */
    private $ID_PT;

    /**
     * @ORM\Column(type="string", length=255)
     *   * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Le nom de l'entreprise doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'entreprise doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $N_Caisse_Nationale;

    /**
     * @ORM\Column(type="string", length=8)
     *   * @Assert\Length(
     *      min = 8,
     *      max = 8,
     *      minMessage = "Le nom de l'entreprise doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'entreprise doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $cin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Accident", mappedBy="salarie")
     */
    private $accident;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Visite", mappedBy="ids")
     */
    private $visites;

    public function __construct()
    {
        $this->accident = new ArrayCollection();
        $this->visites = new ArrayCollection();
    }







    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $date_de_naissance): self
    {
        $this->date_de_naissance = $date_de_naissance;

        return $this;
    }



    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    public function getIDPT(): ?PosteDeTravail
    {
        return $this->ID_PT;
    }

    public function setIDPT(?PosteDeTravail $ID_PT): self
    {
        $this->ID_PT = $ID_PT;

        return $this;
    }

    public function getNCaisseNationale(): ?string
    {
        return $this->N_Caisse_Nationale;
    }

    public function setNCaisseNationale(string $N_Caisse_Nationale): self
    {
        $this->N_Caisse_Nationale = $N_Caisse_Nationale;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * @return Collection|Accident[]
     */
    public function getAccident(): Collection
    {
        return $this->accident;
    }

    public function addAccident(Accident $accident): self
    {
        if (!$this->accident->contains($accident)) {
            $this->accident[] = $accident;
            $accident->setSalarie($this);
        }

        return $this;
    }

    public function removeAccident(Accident $accident): self
    {
        if ($this->accident->contains($accident)) {
            $this->accident->removeElement($accident);
            // set the owning side to null (unless already changed)
            if ($accident->getSalarie() === $this) {
                $accident->setSalarie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Visite[]
     */
    public function getVisites(): Collection
    {
        return $this->visites;
    }

    public function addVisite(Visite $visite): self
    {
        if (!$this->visites->contains($visite)) {
            $this->visites[] = $visite;
            $visite->setIds($this);
        }

        return $this;
    }

    public function removeVisite(Visite $visite): self
    {
        if ($this->visites->contains($visite)) {
            $this->visites->removeElement($visite);
            // set the owning side to null (unless already changed)
            if ($visite->getIds() === $this) {
                $visite->setIds(null);
            }
        }

        return $this;
    }







}

<?php

namespace App\Entity;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\EntrepriseRepository")
 */
class Entreprise
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255,unique=true)
     * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Le nom de l'entreprise doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'entreprise doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Le nom de l'entreprise doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'entreprise doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logo;

    /**
     * @ORM\Column(type="integer")
     */
    private $num_tva;

    /**
     * @ORM\Column(type="string", length=50)
     *   * * @Assert\Length(
     *      min = 7,
     *      max = 50,
     *      minMessage = "Le nom de l'entreprise doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'entreprise doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=20,nullable=true)
     */
    private $fax;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50)
     *   * * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Le nom de l'entreprise doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'entreprise doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $personne_contact;



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

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo( $logo)
    {
        $this->logo = $logo;

        return $this;
    }

    public function getNumTva(): ?int
    {
        return $this->num_tva;
    }

    public function setNumTva(int $num_tva): self
    {
        $this->num_tva = $num_tva;

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

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPersonneContact(): ?string
    {
        return $this->personne_contact;
    }

    public function setPersonneContact(string $personne_contact): self
    {
        $this->personne_contact = $personne_contact;

        return $this;
    }


}
